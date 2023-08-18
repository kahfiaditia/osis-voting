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
use Yajra\DataTables\Facades\DataTables;

class VoteController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Voting';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles == 'Administrator') {
            $list = Vote::all();
            $cek_vote = 0;
        } else {
            $Queryperiode = DB::table('periode')
                ->select('id')
                ->whereNull('flag')
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->get();
            if (count($Queryperiode) > 0) {
                $periode = $Queryperiode[0]->id;
            } else {
                $periode = null;
            }
            $cek_vote = Vote::where('id_user_vote', Auth::user()->id)->where('id_periode', $periode)->count();
            $list = Vote::where('id_user_vote', Auth::user()->id)->get();
        }
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Vote',
            'label' => 'Data Vote',
            'list' => $list,
            'cek_vote' => $cek_vote,
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
            ->whereNull('deleted_at')
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
            ->orderByRaw('kandidat.no_urut ASC')
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

    public function data_voters(Request $request)
    {
        $hasil_vote = DB::table('vote')
            ->whereNull('vote.deleted_at')
            ->orderBy('vote.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $hasil_vote->where(function ($where) use ($search) {
                $where
                    ->orWhere('trx_number', 'like', '%' . $search . '%')
                    ->orWhere('id_periode', 'like', '%' . $search . '%')
                    ->orWhere('id_kandidat', 'like', '%' . $search . '%')
                    ->orWhere('id_user_vote', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $hasil_vote->where(function ($where) use ($search) {
                    $where
                        ->orWhere('trx_number', 'like', '%' . $search . '%')
                        ->orWhere('id_periode', 'like', '%' . $search . '%')
                        ->orWhere('id_kandidat', 'like', '%' . $search . '%')
                        ->orWhere('id_user_vote', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('trx_number') != null) {
                $trx_number = $request->get('trx_number');
                $hasil_vote->where('trx_number', '=', $trx_number);
            }
            if ($request->get('id_periode') != null) {
                $id_periode = $request->get('id_periode');
                $hasil_vote->where('id_periode', '=', $id_periode);
            }
            if ($request->get('id_kandidat') != null) {
                $id_kandidat = $request->get('id_kandidat');
                $hasil_vote->where('id_kandidat', '=', $id_kandidat);
            }
            if ($request->get('id_user_vote') != null) {
                $id_user_vote = $request->get('id_user_vote');
                $hasil_vote->where('id_user_vote', '=', $id_user_vote);
            }
        }

        return DataTables::of($hasil_vote)
            ->addColumn('action', 'vote.button')
            ->rawColumns(['action'])
            ->make(true);
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
