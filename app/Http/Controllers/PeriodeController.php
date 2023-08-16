<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use Illuminate\Http\Request;
use App\Models\PeriodeModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Periode';
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
            'periode' => PeriodeModel::All()
        ];
        return view('periode.list')->with($data);
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
        ];
        return view('periode.tambah')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode' => 'required',
            'flag' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $kelas = new PeriodeModel();
            $kelas->periode_name = $request->periode;
            $kelas->flag = $request->flag;
            $kelas->user_created =  Auth::user()->id;
            $kelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/periode');
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
            'submenu' => 'Periode',
            'label' => 'data Periode',
            'edit' => PeriodeModel::findORFail(
                $id
            )
        ];
        return view('periode.edit')->with($data);
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
            $editkelas = PeriodeModel::findOrFail($id);
            $editkelas->periode_name = $request->periode;
            $editkelas->flag = $request->flag;
            $editkelas->user_updated =  Auth::user()->id;
            $editkelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/periode');
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
        DB::beginTransaction();
        try {
            $hapus = PeriodeModel::findorfail($id);
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
