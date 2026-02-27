<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Cek role sesuai parameter
        $allowedRoles = $arguments; // contoh: ['admin','petugas']
        if (!in_array(session()->get('role'), $allowedRoles)) {
            // Jika role tidak sesuai, redirect ke dashboard siswa
            return redirect()->to('/dashboard/siswa');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan
    }
}
