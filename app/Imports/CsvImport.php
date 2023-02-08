<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
           'first_name' => $row['first_name'],
           'last_name' => $row['last_name'],
           'email' => $row['email'],
           'phone_number' => $row['phone_number'],
        ]);
    }
}

