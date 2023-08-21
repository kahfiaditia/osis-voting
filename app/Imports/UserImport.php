<?php

namespace App\Imports;

use App\Models\User;
use App\Models\TemporaryModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class UserImport implements ToArray
{
    /**
     * @param Collection $collection
     */
    use Importable;

    public function array(array $rows)
    {
        return $rows;
    }

    public function collection(Collection $collection)
    {
    }
}
