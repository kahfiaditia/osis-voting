<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'beranda';

    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
        ];
        return view('dashboard.dashboard')->with($data);
    }
}
