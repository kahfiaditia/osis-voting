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
        return view('kandidat.tambah')->with($data);
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
            $osis->id_ketua = $request->wakil;
            $osis->id_wakil = $request->ketua;
            $osis->id_periode = $request->periode;
            $osis->quote = $request->quote;
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
            'edit' => KandidatModel::findOrFail($id), // Use findOrFail instead of findORFail
            'pilihanwakil' => User::where('roles', '=', "Siswa")->get(),
            'periode' => PeriodeModel::all(),
        ];
        return view('kandidat.edit', $data); // Change ->with($data) to just ,$data
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
        DB::beginTransaction();
        try {
            $editkelas = KandidatModel::findOrFail($id);
            $editkelas->class_name = $request->kelas;
            $editkelas->class_level = $request->level;
            $editkelas->user_updated =  Auth::user()->id;
            $editkelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/class');
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
        // dd($id);
        $hapus1 = KandidatModel::findorfail($id);
        $hapus1->deleted_at = Carbon::now();
        $hapus1->save();


        // DB::beginTransaction();
        // try {
        //     $hapus = ClasessModel::findorfail($id);
        //     $hapus->user_deleted = Auth::user()->id;
        //     $hapus->deleted_at = Carbon::now();
        //     $hapus->save();

        //     DB::commit();
        //     AlertHelper::deleteAlert(true);
        //     return back();
        // } catch (\Throwable $err) {
        //     DB::rollBack();
        //     AlertHelper::deleteAlert(false);
        //     return back();
        // }
    }
}
