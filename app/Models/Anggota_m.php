<?php

namespace App\Models;

use CodeIgniter\Model;

class Anggota_m extends Model
{
    protected $table = 'anggota';
    protected $allowedFields = [
        'kode', 'nama', 'nip', 'jenis_kelamin', 'alamat',
        'id_fakultas', 'tanggal_gabung', 'status', 'foto'
    ];

    public function getAnggota($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
