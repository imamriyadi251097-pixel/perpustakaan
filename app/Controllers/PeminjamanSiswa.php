<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class PeminjamanSiswa extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // Menampilkan riwayat peminjaman siswa yang login
    public function riwayat()
    {
        $siswaId = session()->get('id'); // ambil ID siswa dari session
        $data['peminjaman'] = $this->peminjamanModel
            ->where('anggota_id', $siswaId)
            ->findAll();

        echo view('siswa/riwayat', $data);
    }
}
