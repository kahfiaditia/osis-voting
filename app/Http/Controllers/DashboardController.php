<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'beranda';

    public function index()
    {
        $Queryperiode = DB::table('periode')
            ->select('periode_name')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get();
        if (count($Queryperiode) > 0) {
            $periode = $Queryperiode[0]->periode_name;
        } else {
            $periode = null;
        }
        $hasil_vote = DB::table('kandidat')
            ->select('kandidat.id', 'users.name as ketua', 'users.avatar as foto_ketua', 'w.name as wakil', 'w.avatar as foto_wakil', 'visi_misi')
            ->join('users', 'users.id', '=', 'kandidat.id_ketua')
            ->join('users as w', 'w.id', '=', 'kandidat.id_wakil')
            ->join('periode', 'periode.id', '=', 'kandidat.id_periode')
            ->where('periode_name', $periode)
            ->groupBy('kandidat.id')
            ->orderByRaw('kandidat.id ASC')
            ->get();
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'hasil_vote' => $hasil_vote,
            'user' => User::all(),
            'guru' => User::where('roles', 'Guru')->count(),
            'siswa' => User::where('roles', 'Siswa')->count(),
        ];
        return view('dashboard.dashboard')->with($data);
    }
}
