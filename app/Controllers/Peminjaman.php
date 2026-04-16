<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\AnggotaModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $bukuModel;
    protected $anggotaModel;
    protected $db;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
        $this->db = \Config\Database::connect();
    }

    // =========================
    // LIST DATA
    // =========================
    public function index()
    {
        $builder = $this->db->table('peminjaman p');

        $builder->select('
            p.*,
            a.nama AS nama_anggota,
            b.judul AS judul_buku
        ');

        // 🔥 LEFT JOIN biar data tidak hilang
        $builder->join('anggota a', 'a.id = p.anggota_id', 'left');
        $builder->join('buku b', 'b.id = p.buku_id', 'left');

        $builder->orderBy('p.id', 'DESC');

        return view('peminjaman/index', [
            'peminjaman' => $builder->get()->getResultArray()
        ]);
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('peminjaman/create', [
            'anggota' => $this->anggotaModel->findAll(),
            'buku'    => $this->bukuModel->findAll()
        ]);
    }

    // =========================
    // SIMPAN (PAKAI TRANSAKSI)
    // =========================
    public function save()
    {
        $anggota_id = $this->request->getPost('anggota_id');
        $buku_id    = $this->request->getPost('buku_id');

        if (!$anggota_id || !$buku_id) {
            return redirect()->back()->with('error', 'Data tidak lengkap!');
        }

        $this->db->transStart();

        $buku = $this->bukuModel->find($buku_id);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan!');
        }

        if ($buku['stok'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        // Insert peminjaman
        $this->peminjamanModel->insert([
            'anggota_id'      => $anggota_id,
            'buku_id'         => $buku_id,
            'tanggal_pinjam'  => date('Y-m-d'),
            'status'          => 'dipinjam'
        ]);

        // Update stok
        $this->bukuModel->update($buku_id, [
            'stok' => $buku['stok'] - 1
        ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan data!');
        }

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil!');
    }

    // =========================
    // PENGEMBALIAN (TRANSAKSI)
    // =========================
    public function kembali($id)
    {
        $this->db->transStart();

        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan!');
        }

        if ($peminjaman['status'] == 'kembali') {
            return redirect()->to('/peminjaman')->with('error', 'Sudah dikembalikan!');
        }

        // Update status
        $this->peminjamanModel->update($id, [
            'status'            => 'kembali',
            'tanggal_kembali'   => date('Y-m-d')
        ]);

        // Tambah stok
        $buku = $this->bukuModel->find($peminjaman['buku_id']);
        if ($buku) {
            $this->bukuModel->update($buku['id'], [
                'stok' => $buku['stok'] + 1
            ]);
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->to('/peminjaman')->with('error', 'Gagal proses pengembalian!');
        }

        return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dikembalikan!');
    }

    // =========================
    // DELETE (AMAN)
    // =========================
    public function delete($id)
    {
        $this->db->transStart();

        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan!');
        }

        // Balikin stok kalau masih dipinjam
        if ($peminjaman['status'] == 'dipinjam') {
            $buku = $this->bukuModel->find($peminjaman['buku_id']);
            if ($buku) {
                $this->bukuModel->update($buku['id'], [
                    'stok' => $buku['stok'] + 1
                ]);
            }
        }

        $this->peminjamanModel->delete($id);

        $this->db->transComplete();

        return redirect()->to('/peminjaman')->with('success', 'Data berhasil dihapus!');
    }
}
