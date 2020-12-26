<?php

namespace App\Imports;

use App\PersonalAcademico;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    

        return new PersonalAcademico([
            'nombre' => $row[0],
            'apellido' => $row[1],
            'codigoSis' => $row[2],
            'email' => $row[3],
            'telefono' => $row[4],
        ]);
    }
}
