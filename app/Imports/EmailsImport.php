<?php

namespace App\Imports;

use App\Emails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmailsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Emails([
            "email" => $row["email"],
            "user_name" => $row["user_name"],
            "organisation" => $row["organisation"],
            "source" => $row["source"],
        ]);
    }
}
