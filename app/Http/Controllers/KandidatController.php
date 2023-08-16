<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\KandidatModel;
use App\Models\PeriodeModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Kandidat';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_calonketua()
    {
        $calonosis = DB::table('users')
            ->whereNull('deleted_at')
            ->where('roles', '=', "Siswa")
            ->get();

        if (count($calonosis) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $calonosis,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function get_calonwakil()
    {
        $calonwakil = DB::table('users')
            ->whereNull('deleted_at')
            ->where('roles', '=', "Siswa")
            ->get();

        if (count($calonwakil) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $calonwakil,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function edit_get_nisketua(Request $request)
    {
        // dd($request->id_ketua);
        $ketua = $request->id_ketua;
        $nis = DB::table('users')
            ->select('nis')
            ->where('id', $ketua)
            ->first();

        if ($nis) {
            return response()->json([
                'code' => 200,
                'data' => $nis,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function edit_get_niswakil(Request $request)
    {
        // dd($request->id_ketua);
        $wakil = $request->id_wakil;
        $nis = DB::table('users')
            ->select('nis')
            ->where('id', $wakil)
            ->first();

        if ($nis) {
            return response()->json([
                'code' => 200,
                'data' => $nis,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'kandidat' => KandidatModel::All()
        ];
        return view('kandidat.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            // 'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'ketua' => User::where('roles', '=', "Siswa")->get(),
            'wakil' => User::where('roles', '=', "Siswa")->get(),
            'periode' => PeriodeModel::all(),
        ];
        return view('kandidat.tambah2')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $osis = new KandidatModel();
            $osis->id_ketua = $request->ketua;
            $osis->id_wakil = $request->wakil;
            $osis->id_periode = $request->periode;
            $osis->quote = $request->quote;
            $osis->no_urut = $request->urut;
            $osis->visi_misi = $request->editor1;
            $osis->user_created =  Auth::user()->id;
            $osis->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/kandidat');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
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
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'data Kandidat',
            'pilihan' => User::where('roles', '=', "Siswa")->get(),
            'kandidat' => KandidatModel::findOrFail($id), // Use findOrFail instead of findORFail
            'pilihanwakil' => User::where('roles', '=', "Siswa")->get(),
            'periode' => PeriodeModel::all(),
        ];
        return view('kandidat.edit', $data);
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
        // dd($request);
        DB::beginTransaction();
        try {
            $editkelas = KandidatModel::findOrFail($id);
            $editkelas->id_ketua = $request->ketua;
            $editkelas->id_wakil = $request->wakil;
            $editkelas->no_urut = $request->urut;
            $editkelas->id_periode = $request->level;
            $editkelas->quote = $request->quote;
            $editkelas->visi_misi = $request->editor1;
            $editkelas->user_updated =  Auth::user()->id;
            $editkelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/kandidat');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $hapus = KandidatModel::findorfail($id);
            $hapus->user_deleted = Auth::user()->id;
            $hapus->deleted_at = Carbon::now();
            $hapus->save();

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }
}
