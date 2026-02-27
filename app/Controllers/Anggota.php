<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    // Tampilkan daftar anggota
    public function index()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        echo view('anggota/index', $data);
    }

    // Form tambah anggota
    public function create()
    {
        echo view('anggota/create');
    }

    // Simpan anggota baru (handle upload foto)
    public function save()
    {
        $fotoFile = $this->request->getFile('foto');
        $fotoName = null;

        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $fotoName = $fotoFile->getRandomName();
            $fotoFile->move(ROOTPATH . 'public/assets/foto', $fotoName);
        }

        $this->anggotaModel->save([
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'jenis'  => $this->request->getPost('jenis'),
            'foto'   => $fotoName
        ]);

        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil disimpan.');
    }

    // Form edit anggota
    public function edit($id)
    {
        $data['anggota'] = $this->anggotaModel->find($id);
        echo view('anggota/edit', $data);
    }

    // Update anggota (handle upload foto baru)
    public function update($id)
    {
        $anggota = $this->anggotaModel->find($id);
        $fotoFile = $this->request->getFile('foto');
        $fotoName = $anggota['foto']; // default tetap pakai foto lama

        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $fotoName = $fotoFile->getRandomName();
            $fotoFile->move(ROOTPATH . 'public/assets/foto', $fotoName);

            // hapus foto lama jika ada
            if (!empty($anggota['foto']) && file_exists(ROOTPATH . 'public/assets/foto/' . $anggota['foto'])) {
                unlink(ROOTPATH . 'public/assets/foto/' . $anggota['foto']);
            }
        }

        $this->anggotaModel->update($id, [
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'jenis'  => $this->request->getPost('jenis'),
            'foto'   => $fotoName
        ]);

        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Hapus anggota
    public function delete($id)
    {
        $anggota = $this->anggotaModel->find($id);

        // hapus foto jika ada
        if (!empty($anggota['foto']) && file_exists(ROOTPATH . 'public/assets/foto/' . $anggota['foto'])) {
            unlink(ROOTPATH . 'public/assets/foto/' . $anggota['foto']);
        }

        $this->anggotaModel->delete($id);
        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil dihapus.');
    }
}
