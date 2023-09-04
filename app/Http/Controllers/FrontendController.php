<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'all_vote' => User::where('roles', '!=', 'Administrator')->count(),
            'list' => 'login',
        ];
        return view('frontend.awal');
    }

    public function grafik()
    {
        $Queryperiode = DB::table('periode')
            ->select('periode_name', 'flag')
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get();
        if (count($Queryperiode) > 0) {
            $periode = $Queryperiode[0]->periode_name;
            $flag = $Queryperiode[0]->flag;
        } else {
            $periode = null;
            $flag = 'kosong';
        }

        $hasil_vote = DB::table('kandidat')
            ->select('users.name as ketua', 'users.avatar as foto_ketua', 'w.name as wakil', 'w.avatar as foto_wakil', 'visi_misi', 'no_urut', 'vote.id_kandidat')
            ->selectRaw('COUNT(vote.id) as jml')
            ->join('users', 'users.id', '=', 'kandidat.id_ketua')
            ->join('users as w', 'w.id', '=', 'kandidat.id_wakil')
            ->leftJoin('vote', 'vote.id_kandidat', '=', 'kandidat.id')
            ->join('periode', 'periode.id', '=', 'kandidat.id_periode')
            ->whereNull('kandidat.deleted_at')
            ->where('periode_name', $periode)
            ->groupBy('kandidat.id')
            ->orderByRaw('no_urut ASC')
            ->get();

        $jml_vote = DB::table('vote')
            ->selectRaw('COUNT(vote.id) as jml_vote')
            ->join('periode', 'periode.id', '=', 'vote.id_periode')
            ->join('kandidat', 'kandidat.id', '=', 'vote.id_kandidat')
            ->whereNull('kandidat.deleted_at')
            ->where('periode_name', $periode)
            ->get();

        $winner = DB::table('vote')
            ->select('id_kandidat')
            ->join('periode', 'periode.id', '=', 'vote.id_periode')
            ->where('periode_name', $periode)
            ->groupBy('vote.id_kandidat')
            ->orderByRaw('COUNT(vote.id) DESC')
            ->limit(1)
            ->get();
        $data = [
            'all_vote' => User::where('roles', '!=', 'Administrator')->count(),
            'hasil_vote' => $hasil_vote,
            'jml_vote' => $jml_vote,
            'periode' => $periode,
            'flag' => $flag,
            'winner' => $winner,
        ];
        return view('frontend.grafik', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
