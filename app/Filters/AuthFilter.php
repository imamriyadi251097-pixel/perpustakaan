<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Fungsi sebelum request diproses
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika user belum login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Jika ada role spesifik yang diberikan pada route
        if ($arguments) {
            $roleAllowed = $arguments; // array role yang diperbolehkan
            $userRole = $session->get('role');

            if (!in_array($userRole, $roleAllowed)) {
                // Redirect sesuai role user
                switch ($userRole) {
                    case 'admin':
                        return redirect()->to('/dashboard/admin');
                    case 'petugas':
                        return redirect()->to('/dashboard/petugas');
                    case 'siswa':
                        return redirect()->to('/dashboard/siswa');
                    default:
                        $session->destroy();
                        return redirect()->to('/login');
                }
            }
        }
    }

    /**
     * Fungsi setelah request diproses (optional)
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah request
    }
}
