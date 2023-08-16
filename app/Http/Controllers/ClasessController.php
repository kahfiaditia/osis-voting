<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClasessModel;
use App\Helper\AlertHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClasessController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Kelas';
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
        return view('clasess.data')->with($data);
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

    public function data_kelas(Request $request)
    {
        $userdata = DB::table('clasess')
            ->whereNull('clasess.deleted_at')
            ->orderBy('clasess.id', 'DESC');


        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('class_name', 'like', '%' . $search . '%')
                    ->orWhere('class_level', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('class_name', 'like', '%' . $search . '%')
                        ->orWhere('class_level', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('class_name') != null) {
                $class_name = $request->get('class_name');
                $userdata->where('class_name', '=', $class_name);
            }
            if ($request->get('class_level') != null) {
                $class_level = $request->get('class_level');
                $userdata->where('class_level', '=', $class_level);
            }
            if ($request->get('class_name') != null) {
                $class_name = $request->get('class_name');
                $userdata->where('class_name', '=', $class_name);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'clasess.aksi')
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
            'kelas' => 'required|max:25',
        ]);

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
            'submenu' => 'Kelas',
            'label' => 'data Kelas',
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
