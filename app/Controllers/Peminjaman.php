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

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
    }

    // Tampilkan daftar peminjaman
    public function index()
    {
        $builder = $this->peminjamanModel
            ->select('peminjaman.*, anggota.nama, buku.judul')
            ->join('anggota', 'anggota.id = peminjaman.anggota_id')
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->orderBy('peminjaman.id', 'DESC');

        $data['peminjaman'] = $builder->get()->getResultArray();
        return view('peminjaman/index', $data);
    }

    // Form tambah peminjaman
    public function create()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        $data['buku'] = $this->bukuModel->findAll();
        return view('peminjaman/create', $data);
    }

    // Simpan peminjaman baru
    public function save()
    {
        $anggota_id = $this->request->getPost('anggota_id');
        $buku_id = $this->request->getPost('buku_id');

        // Cek stok buku
        $buku = $this->bukuModel->find($buku_id);
        if ($buku['stok'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak cukup!');
        }

        // Simpan peminjaman
        $this->peminjamanModel->save([
            'anggota_id' => $anggota_id,
            'buku_id' => $buku_id,
            'tanggal_pinjam' => date('Y-m-d'),
            'status' => 'dipinjam'
        ]);

        // Kurangi stok buku
        $this->bukuModel->update($buku_id, ['stok' => $buku['stok'] - 1]);

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // Kembalikan buku
    public function kembali($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);
        if (!$peminjaman || $peminjaman['status'] == 'kembali') {
            return redirect()->to('/peminjaman')->with('error', 'Buku sudah dikembalikan.');
        }

        // Update status & tanggal_kembali
        $this->peminjamanModel->update($id, [
            'status' => 'kembali',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        // Tambah stok buku
        $buku = $this->bukuModel->find($peminjaman['buku_id']);
        $this->bukuModel->update($buku['id'], ['stok' => $buku['stok'] + 1]);

        return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dikembalikan.');
    }

    // Hapus peminjaman
    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        return redirect()->to('/peminjaman')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
