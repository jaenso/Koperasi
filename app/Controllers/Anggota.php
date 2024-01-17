<?php

namespace App\Controllers;

use App\Models\Anggota_m;
use App\Models\Fakultas_m;

class Anggota extends BaseController
{
    protected $anggota_m;
    protected $fakultas_m;

    public function __construct()
    {
        $this->anggota_m = new Anggota_m();
        $this->fakultas_m = new Fakultas_m();
    }
    public function index()
    {
        $data = [
            'title' => 'Anggota',
            'anggota' => $this->anggota_m->getAnggota()
        ];

        return view('Bendahara/Anggota/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Anggota',
            'anggota' => $this->anggota_m->getAnggota($id)
        ];

        dd($data);

        if (empty($data['anggota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anggota dengan id ' . $id . ' tidak ditemukan');
        }
        // return view('Bendahara/detail_anggota', $data);
    }

    public function tambah()
    {
        session();
        $data = [
            'title' => 'Tambah Anggota',
            'validation' => \Config\Services::validation(),
            'fakultas' => $this->fakultas_m->getFakultas(),
        ];

        return view('Bendahara/Anggota/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[anggota.nama]',
                'errors' => [
                    'required' => '{field} anggota harus diisi',
                    'is_unique' => '{field} anggota sudah ada'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File yang terpilih bukan format gambar',
                    'mime_in' => 'File yang terlilih bukan format gambar',
                ]
            ]
        ])) {
            return redirect()->to('/anggota/tambah')->withInput();
        }

        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = 'default.jpg';
        } else {
            $nama_foto = $foto->getRandomName();
            $foto->move('ProfilAnggota', $nama_foto);
        }

        $id_fakultas = $this->request->getPost('id_fakultas');
        $kode = $this->fakultas_m->find($id_fakultas)['kode'];

        $anggotaLama = $this->fakultas_m->getAnggotaLama($kode);
        $anggotaBaru = $this->generateKode($kode, $anggotaLama);

        $this->anggota_m->save([
            'kode' => $anggotaBaru,
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'id_fakultas' => $id_fakultas,
            'tanggal_gabung' => $this->request->getPost('tanggal_gabung'),
            'status' => $this->request->getPost('status'),
            'foto' => $nama_foto,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah');

        return redirect()->to('/anggota');
    }

    private function generateKode($kode, $anggotaLama)
    {
        $numeric = intval(substr($anggotaLama, -2));

        $numeric++;

        $kodeBaru = $kode . '-' . sprintf('%02d', $numeric);

        return $kodeBaru;
    }

    public function delete($id)
    {
        $anggota = $this->anggota_m->find($id);
        if ($anggota['foto'] != 'default.png') {
            unlink('ProfilAnggota/' . $anggota['foto']);
        }
        $this->anggota_m->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/anggota');
    }

    public function edit($id)
    {
        session();
        $data = [
            'title' => 'Ubah Anggota',
            'validation' => \Config\Services::validation(),
            'anggota' => $this->anggota_m->getAnggota($id)
        ];

        return view('Bendahara/Anggota/ubah', $data);
    }

    public function update($id)
    {
        $anggota = $this->anggota_m->getAnggota($this->request->getVar('id'));
        if ($anggota['kode'] == $this->request->getVar('kode')) {
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
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File yang terpilih bukan format gambar',
                    'mime_in' => 'File yang terlilih bukan format gambar',
                ]
            ]
        ])) {
            return redirect()->to('/anggota/edit/' . $this->request->getVar('id'))->withInput();
        }

        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = $this->request->getVar('fotoLama');
        } else {
            $nama_foto = $foto->getRandomName();
            $foto->move('ProfilAnggota', $nama_foto);
            unlink('ProfilAnggota/' . $this->request->getVar('fotoLama'));
        }

        $this->anggota_m->save([
            'id' => $id,
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'id_fakultas' => $this->request->getPost('id_fakultas'),
            'tanggal_gabung' => $this->request->getPost('tanggal_gabung'),
            'status' => $this->request->getPost('status'),
            'foto' => $nama_foto,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/anggota');
    }
}
