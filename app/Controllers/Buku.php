<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    // List semua buku
    public function index()
    {
        $data['buku'] = $this->bukuModel->findAll();
        echo view('buku/index', $data);
    }

    // Form tambah buku
    public function create()
    {
        echo view('buku/create');
    }

    // Simpan buku baru
    public function store()
    {
        $file = $this->request->getFile('cover');
        $cover = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $cover = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/img', $cover);
        }

        $this->bukuModel->save([
            'judul'  => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'jenis'  => $this->request->getPost('jenis'),
            'stok'   => $this->request->getPost('stok'),
            'cover'  => $cover
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Form edit buku
    public function edit($id)
    {
        $data['buku'] = $this->bukuModel->find($id);
        echo view('buku/edit', $data);
    }

    // Update buku
    public function update($id)
    {
        $buku = $this->bukuModel->find($id);

        $judul   = $this->request->getPost('judul');
        $penulis = $this->request->getPost('penulis');
        $jenis   = $this->request->getPost('jenis');
        $stok    = $this->request->getPost('stok');

        $file = $this->request->getFile('cover');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/img', $newName);

            // Hapus cover lama
            if (!empty($buku['cover']) && file_exists(ROOTPATH . 'public/assets/img/' . $buku['cover'])) {
                unlink(ROOTPATH . 'public/assets/img/' . $buku['cover']);
            }

            $cover = $newName;
        } else {
            $cover = $buku['cover'];
        }

        $this->bukuModel->update($id, [
            'judul'  => $judul,
            'penulis' => $penulis,
            'jenis'  => $jenis,
            'stok'   => $stok,
            'cover'  => $cover
        ]);

        return redirect()->to('/buku')->with('success', 'Data buku berhasil diperbarui.');
    }

    // Hapus buku
    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if ($buku) {
            if (!empty($buku['cover']) && file_exists(ROOTPATH . 'public/assets/img/' . $buku['cover'])) {
                unlink(ROOTPATH . 'public/assets/img/' . $buku['cover']);
            }

            $this->bukuModel->delete($id);
            return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus.');
        }

        return redirect()->to('/buku')->with('error', 'Buku tidak ditemukan.');
    }

    // Detail buku / cover besar
    public function show($id)
    {
        $data['buku'] = $this->bukuModel->find($id);

        if (!$data['buku']) {
            return redirect()->to('/buku')->with('error', 'Buku tidak ditemukan.');
        }

        echo view('buku/show', $data);
    }
}
