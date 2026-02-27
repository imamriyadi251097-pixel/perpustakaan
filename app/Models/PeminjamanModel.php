<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['anggota_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    // Untuk join data buku & anggota
    public function getAll()
    {
        return $this->select('peminjaman.*, anggota.nama as nama_anggota, buku.judul as judul_buku')
            ->join('anggota', 'anggota.id = peminjaman.anggota_id')
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->findAll();
    }
}
