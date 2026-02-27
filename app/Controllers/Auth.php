<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function process()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            $this->session->setFlashdata('error', 'Username dan password harus diisi.');
            return redirect()->back()->withInput();
        }

        $user = $this->userModel->where('username', $username)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            $this->session->setFlashdata('error', 'Username atau password salah.');
            return redirect()->back()->withInput();
        }

        $this->session->set([
            'id'        => $user['id'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => TRUE
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!$username || !$email || !$password || !$confirmPassword) {
            $this->session->setFlashdata('error', 'Semua field harus diisi.');
            return redirect()->back()->withInput();
        }

        if ($password !== $confirmPassword) {
            $this->session->setFlashdata('error', 'Password dan konfirmasi tidak sama.');
            return redirect()->back()->withInput();
        }

        // Cek username/email
        if ($this->userModel->where('username', $username)->first()) {
            $this->session->setFlashdata('error', 'Username sudah digunakan.');
            return redirect()->back()->withInput();
        }

        // Hapus cek email jika database belum punya kolom email
        // if ($this->userModel->where('email', $email)->first()) {
        //     $this->session->setFlashdata('error', 'Email sudah digunakan.');
        //     return redirect()->back()->withInput();
        // }

        $this->userModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'siswa' // default role
        ]);

        $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/login');
    }
}
