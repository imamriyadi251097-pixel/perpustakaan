<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Ambil role
        $role = session()->get('role');

        // Load Model
        $bukuModel       = new BukuModel();
        $anggotaModel    = new AnggotaModel();
        $peminjamanModel = new PeminjamanModel();

        // Data Statistik
        $data = [
            'dataBuku'      => $bukuModel->countAll(),
            'dataAnggota'   => $anggotaModel->countAll(),
            'dataPinjam'    => $peminjamanModel->countAll(),

            // Data Chart Bulanan (6 bulan terakhir)
            'chartBulanan' => $peminjamanModel
                ->select("MONTH(tanggal_pinjam) as bulan, COUNT(*) as total")
                ->where("tanggal_pinjam >=", date('Y-m-01', strtotime('-5 months')))
                ->groupBy("MONTH(tanggal_pinjam)")
                ->orderBy("MONTH(tanggal_pinjam)", "ASC")
                ->findAll(),

            // Data Donut (Jenis Buku)
            'chartJenis' => $bukuModel
                ->select("jenis, COUNT(*) as total")
                ->groupBy("jenis")
                ->findAll()
        ];

        switch ($role) {
            case 'admin':
                return view('dashboard/admin', $data);

            case 'petugas':
                return view('dashboard/petugas', $data);

            case 'siswa':
                return view('dashboard/siswa', $data);

            default:
                return redirect()->to('/login');
        }
    }
}
