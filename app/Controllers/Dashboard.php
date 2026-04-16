<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    protected $bukuModel;
    protected $anggotaModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->bukuModel       = new BukuModel();
        $this->anggotaModel    = new AnggotaModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        // =========================
        // VALIDASI LOGIN
        // =========================
        if (!session()->get('role')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        // =========================
        // STATISTIK UTAMA
        // =========================
        $dataBuku    = $this->bukuModel->countAll();
        $dataAnggota = $this->anggotaModel->countAll();
        $dataPinjam  = $this->peminjamanModel->countAll();

        // 🔥 TOTAL PENGEMBALIAN
        $dataKembali = $this->peminjamanModel
            ->where('status', 'kembali')
            ->countAllResults();

        // =========================
        // CHART BULANAN (6 BULAN)
        // =========================
        $chartBulanan = $this->peminjamanModel
            ->select("MONTH(tanggal_pinjam) as bulan, COUNT(*) as total")
            ->where("tanggal_pinjam >=", date('Y-m-01', strtotime('-5 months')))
            ->groupBy("MONTH(tanggal_pinjam)")
            ->orderBy("MONTH(tanggal_pinjam)", "ASC")
            ->findAll();

        // =========================
        // CHART JENIS BUKU
        // =========================
        $chartJenis = $this->bukuModel
            ->select("jenis, COUNT(*) as total")
            ->groupBy("jenis")
            ->findAll();

        // =========================
        // CHART STATUS (BARU 🔥)
        // =========================
        $chartStatus = $this->peminjamanModel
            ->select("status, COUNT(*) as total")
            ->groupBy("status")
            ->findAll();

        // =========================
        // KALENDER PINJAM
        // =========================
        $tanggalPinjam = $this->peminjamanModel
            ->select("DAY(tanggal_pinjam) as hari")
            ->where("MONTH(tanggal_pinjam)", date('m'))
            ->findAll();

        // =========================
        // KALENDER KEMBALI (BARU 🔥)
        // =========================
        $tanggalKembali = $this->peminjamanModel
            ->select("DAY(tanggal_kembali) as hari")
            ->where("tanggal_kembali IS NOT NULL")
            ->where("MONTH(tanggal_kembali)", date('m'))
            ->findAll();

        // =========================
        // KIRIM DATA
        // =========================
        $data = [
            'dataBuku'        => $dataBuku,
            'dataAnggota'     => $dataAnggota,
            'dataPinjam'      => $dataPinjam,
            'dataKembali'     => $dataKembali,

            'chartBulanan'    => $chartBulanan,
            'chartJenis'      => $chartJenis,
            'chartStatus'     => $chartStatus,

            'tanggalPinjam'   => $tanggalPinjam,
            'tanggalKembali'  => $tanggalKembali
        ];

        // =========================
        // ROLE VIEW
        // =========================
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
