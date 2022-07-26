<?php

namespace App\Exports;

use App\Models\Pegawais;
use Maatwebsite\Excel\Concerns\FromCollection;

class PegawaiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegawais::all();
    }
}
