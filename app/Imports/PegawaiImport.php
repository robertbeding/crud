<?php

namespace App\Imports;

use App\Models\Pegawais;
use Maatwebsite\Excel\Concerns\ToModel;

class PegawaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawais([
            'nama' => $row[1], 
            'jeniskelamin' => $row[2],
            'notelepon' => $row[3],
            'foto' => $row[4],
        ]);
    }
}
