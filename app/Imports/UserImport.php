<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        Log::info('Processing data:', $row);
        // Assuming the columns in the Excel file are in the following order:
        // Role, Nama, Nis, NIK, Kelas, Email, Alamat, Phone

        return new User([
            'role' => $row[0],
            'nama' => $row[1],
            'nis' => $row[2],
            'nik' => $row[3],
            'kelas' => $row[4],
            'email' => $row[5],
            'alamat' => $row[6],
            'telepon' => $row[7],
        ]);
    }
}
