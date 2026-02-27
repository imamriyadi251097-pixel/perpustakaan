<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Siswa extends BaseController
{
    public function index()
    {
        // Data bisa dikirim ke view kalau perlu
        return view('dashboard_siswa');
    }
}
