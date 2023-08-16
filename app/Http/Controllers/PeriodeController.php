<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use Illuminate\Http\Request;
use App\Models\PeriodeModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        return view('periode.data')->with($data);
    }

    public function data_periode(Request $request)
    {
        $userdata = DB::table('periode')
            ->whereNull('periode.deleted_at')
            ->orderBy('periode.id', 'DESC');


        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('periode_name', 'like', '%' . $search . '%')
                    ->orWhere('flag', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('periode_name', 'like', '%' . $search . '%')
                        ->orWhere('flag', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('periode_name') != null) {
                $periode_name = $request->get('periode_name');
                $userdata->where('periode_name', '=', $periode_name);
            }
            if ($request->get('flag') != null) {
                $flag = $request->get('flag');
                $userdata->where('flag', '=', $flag);
            }
            if ($request->get('periode_name') != null) {
                $periode_name = $request->get('periode_name');
                $userdata->where('periode_name', '=', $periode_name);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'periode.button')
            ->rawColumns(['action'])
            ->make(true);
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
