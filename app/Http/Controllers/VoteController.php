<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Kandidat;
use App\Models\KandidatModel;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles == 'Administrator') {
            $list = Vote::all();
        } else {
            $list = Vote::where('id_user_vote', Auth::user()->id)->get();
        }
        $data = [
            'menu' => 'Apps',
            'submenu' => 'Vote',
            'label' => 'Data Vote',
            'list' => $list,
        ];
        return view('vote.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            ->selectRaw('COUNT(vote.id) as jml')
            ->join('users', 'users.id', '=', 'kandidat.id_ketua')
            ->join('users as w', 'w.id', '=', 'kandidat.id_wakil')
            ->leftJoin('vote', 'vote.id_kandidat', '=', 'kandidat.id')
            ->join('periode', 'periode.id', '=', 'kandidat.id_periode')
            ->where('periode_name', $periode)
            ->groupBy('kandidat.id')
            ->orderByRaw('kandidat.id ASC')
            ->get();

        $jml_vote = DB::table('vote')
            ->selectRaw('COUNT(vote.id) as jml_vote')
            ->join('periode', 'periode.id', '=', 'vote.id_periode')
            ->join('kandidat', 'kandidat.id', '=', 'vote.id_kandidat')
            ->where('periode_name', $periode)
            ->get();
        $data = [
            'menu' => 'Apps',
            'submenu' => 'Vote',
            'label' => 'Data Vote',
            'all_vote' => User::where('roles', '!=', 'Administrator')->count(),
            'hasil_vote' => $hasil_vote,
            'jml_vote' => $jml_vote,
            'periode' => $periode,
        ];
        return view('vote.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'satu' => 'required',
            'dua' => 'required',
            'tiga' => 'required',
            'empat' => 'required',
        ]);
        $code = $request->satu . $request->dua . $request->tiga . $request->empat;

        $user = User::where('email', $request->email)->first();
        if ($user->pin == $code) {
            $registration_number = Vote::limit(1)->groupBy('trx_number')->orderBy('id', 'desc')->get();
            if (count($registration_number) > 0) {
                $thn = substr($registration_number[0]->trx_number, 0, 2);
                if ($thn == Carbon::now()->format('y')) {
                    $date = $thn . Carbon::now()->format('md');
                    $nomor = (int) substr($registration_number[0]->trx_number, 6, 4) + 1;

                    $Nol = "";
                    $nilai = 4 - strlen($nomor);
                    for ($i = 1; $i <= $nilai; $i++) {
                        $Nol = $Nol . "0";
                    }
                    $trx_number   = $date . $Nol .  $nomor;
                } else {
                    $trx_number   = Carbon::now()->format('ymd') . "0001";
                }
            } else {
                $trx_number   = Carbon::now()->format('ymd') . "0001";
            }

            $kandidat = KandidatModel::findorfail($request->id_kandidat);
            DB::beginTransaction();
            try {
                $rak = new Vote();
                $rak->trx_number = $trx_number;
                $rak->id_user_vote = Auth::user()->id;
                $rak->id_kandidat = $request->id_kandidat;
                $rak->id_periode = $kandidat->id_periode;
                $rak->user_created = Auth::user()->id;
                $rak->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('vote');
            } catch (\Throwable $err) {
                DB::rollback();
                throw $err;
                AlertHelper::addAlert(false);
                return back();
            }
        } else {
            AlertHelper::addAlert(false);
            return back();
        }
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
