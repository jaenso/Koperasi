<?php

namespace App\Controllers;

use App\Models\Fakultas_m;

class Fakultas extends BaseController
{
    protected $fakultas_m;

    public function __construct()
    {
        $this->fakultas_m = new Fakultas_m();
    }
    public function index()
    {
        $data = [
            'title' => 'Fakultas',
            'fakultas' => $this->fakultas_m->getFakultas()
        ];

        return view('Bendahara/Fakultas/index', $data);
    }


    public function tambah()
    {
        session();
        $data = [
            'title' => 'Tambah Fakultas',
            'validation' => \Config\Services::validation(),
        ];

        return view('Bendahara/Fakultas/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|is_unique[fakultas.kode]',
                'errors' => [
                    'required' => '{field} fakultas harus diisi',
                    'is_unique' => '{field} fakultas sudah ada'
                ]
            ],
        ])) {
            return redirect()->to('/fakultas/tambah')->withInput();
        }

        $this->fakultas_m->save([
            'kode' => $this->request->getPost('kode'),
            'fakultas' => $this->request->getPost('fakultas'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah');

        return redirect()->to('/fakultas');
    }

    public function delete($id)
    {
        $this->fakultas_m->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/fakultas');
    }

    public function edit($id)
    {
        session();
        $data = [
            'title' => 'Ubah Fakultas',
            'validation' => \Config\Services::validation(),
            'fakultas' => $this->fakultas_m->getFakultas($id)
        ];

        return view('Bendahara/Fakultas/ubah', $data);
    }

    public function update($id)
    {
        $fakultas = $this->fakultas_m->getFakultas($this->request->getVar('id'));
        if ($fakultas['kode'] == $this->request->getVar('kode')) {
            $rule_kode = 'required';
        } else {
            $rule_kode = 'required|is_unique[anggota.kode]';
        }
        if (!$this->validate([
            'kode' => [
                'rules' => $rule_kode,
                'errors' => [
                    'required' => '{field} anggota harus diisi',
                    'is_unique' => '{field} anggota sudah ada'
                ]
            ],
        ])) {
            return redirect()->to('/fakultas/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->fakultas_m->save([
            'id' => $id,
            'kode' => $this->request->getPost('kode'),
            'fakultas' => $this->request->getPost('fakultas'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/fakultas');
    }
}
