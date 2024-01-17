<?php

namespace App\Models;

use CodeIgniter\Model;

class Fakultas_m extends Model
{
    protected $table = 'fakultas';
    protected $allowedFields = [
        'kode', 'fakultas'
    ];

    public function getFakultas($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getAnggotaLama($kode)
    {
        $builder = $this->select('kode')->like('kode', $kode, 'after')->orderBy('kode', 'DESC')->limit(1);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $kodeTerakhir = $query->getRow()->kode;
        } else {
            $kodeTerakhir = $kode . '-00';
        }

        return $kodeTerakhir;
    }
}
