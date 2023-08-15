<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClasessModel;
use App\Helper\AlertHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ClasessController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Classes';
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
            'kelas' => ClasessModel::All()
        ];
        return view('clasess.list')->with($data);
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
        return view('clasess.tambah')->with($data);
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
            $kelas = new ClasessModel();
            $kelas->class_name = $request->kelas;
            $kelas->class_level = $request->level;
            $kelas->user_created =  Auth::user()->id;
            $kelas->save();

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
            'submenu' => 'Clasess',
            'label' => 'data Clasess',
            'edit' => ClasessModel::findORFail(
                $id
            )
        ];
        return view('clasess.edit')->with($data);
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
        // dd($id);
        DB::beginTransaction();
        try {
            $editkelas = ClasessModel::findOrFail($id);
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
        // $hapus1 = ClasessModel::findorfail($id);
        // $hapus1->deleted_at = Carbon::now();
        // $hapus1->save();


        DB::beginTransaction();
        try {
            $hapus = ClasessModel::findorfail($id);
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
