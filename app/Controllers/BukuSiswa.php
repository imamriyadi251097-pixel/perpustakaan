<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class BukuSiswa extends BaseController
{
    protected $bukuModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    // Menampilkan daftar buku untuk siswa
    public function index()
    {
        $data['buku'] = $this->bukuModel->findAll();
        echo view('siswa/buku_list', $data);
    }

    // Fungsi pinjam buku
    public function pinjam($id)
    {
        $userId = session()->get('id'); // ID siswa dari session

        // Cek stok buku
        $buku = $this->bukuModel->find($id);
        if (!$buku || $buku['stok'] < 1) {
            return redirect()->to('/siswa/buku')->with('error', 'Buku tidak tersedia');
        }

        // Simpan peminjaman
        $this->peminjamanModel->save([
            'anggota_id' => $userId,
            'buku_id'    => $id,
            'tanggal_pinjam' => date('Y-m-d')
        ]);

        // Kurangi stok buku
        $this->bukuModel->update($id, [
            'stok' => $buku['stok'] - 1
        ]);

        return redirect()->to('/siswa/buku')->with('success', 'Buku berhasil dipinjam!');
    }
}
