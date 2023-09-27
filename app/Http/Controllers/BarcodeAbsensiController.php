<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeAbsensiController extends Controller
{
    protected $title = 'Ekstrakurikuler';
    protected $menu = 'Absensi';

    public function barcode_absensi()
    {
        // dd($id);

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'kegiatan' => 'Ekstrakulikuler',
            'label' => 'Data',
        ];
        return view('absensi.absensi_barcode')->with($data);
    }
}
