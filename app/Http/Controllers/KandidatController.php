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
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

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

    public function data_kandidat(Request $request)
    {
        $userdata = DB::table('kandidat')
            ->select(
                'kandidat.id',
                'kandidat.id_ketua as ketua',
                'u1.name as ketua_name',
                'kandidat.id_wakil as wakil',
                'u2.name as wakil_name',
                'kandidat.no_urut',
                'kandidat.id_periode as periode',
                'p.periode_name as periode_name',
                'kandidat.quote',
                'kandidat.visi_misi'
            )
            ->leftJoin('users as u1', 'kandidat.id_ketua', '=', 'u1.id')
            ->leftJoin('users as u2', 'kandidat.id_wakil', '=', 'u2.id')
            ->join('periode as p', 'kandidat.id_periode', '=', 'p.id')
            ->whereNull('kandidat.deleted_at')
            ->orderBy('kandidat.id', 'DESC')
            ->get();


        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('ketua_name', 'like', '%' . $search . '%')
                    ->orWhere('wakil_name', 'like', '%' . $search . '%')
                    ->orWhere('no_urut', 'like', '%' . $search . '%')
                    ->orWhere('periode_name', 'like', '%' . $search . '%')
                    ->orWhere('quote', 'like', '%' . $search . '%')
                    ->orWhere('visi_misi', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('ketua_name', 'like', '%' . $search . '%')
                        ->orWhere('wakil_name', 'like', '%' . $search . '%')
                        ->orWhere('no_urut', 'like', '%' . $search . '%')
                        ->orWhere('periode_name', 'like', '%' . $search . '%')
                        ->orWhere('quote', 'like', '%' . $search . '%')
                        ->orWhere('visi_misi', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('ketua_name') != null) {
                $ketua_name = $request->get('ketua_name');
                $userdata->where('ketua_name', '=', $ketua_name);
            }
            if ($request->get('wakil_name') != null) {
                $wakil_name = $request->get('wakil_name');
                $userdata->where('wakil_name', '=', $wakil_name);
            }
            if ($request->get('no_urut') != null) {
                $no_urut = $request->get('no_urut');
                $userdata->where('no_urut', '=', $no_urut);
            }
            if ($request->get('periode_name') != null) {
                $periode_name = $request->get('periode_name');
                $userdata->where('periode_name', '=', $periode_name);
            }
            if ($request->get('quote') != null) {
                $quote = $request->get('quote');
                $userdata->where('quote', '=', $quote);
            }
            if ($request->get('visi_misi') != null) {
                $visi_misi = $request->get('visi_misi');
                $userdata->where('visi_misi', '=', $visi_misi);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'kandidat.button')
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
        $validated = $request->validate([
            'ketua' => 'required',
            'wakil' => 'required',
            'periode' => 'required',
            'quote' => 'required',
            'urut' => 'required',
            'elm1' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $osis = new KandidatModel();
            $osis->id_ketua = $request->ketua;
            $osis->id_wakil = $request->wakil;
            $osis->id_periode = $request->periode;
            $osis->quote = $request->quote;
            $osis->no_urut = $request->urut;
            $osis->visi_misi = $request->elm1;
            $osis->user_created =  Auth::user()->id;
            if ($request->type_foto == 'Kandidat') {
                if ($request->avatar) {
                    $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                    $osis->avatar_kandidat = $fileName;
                    $request->avatar->move(public_path('avatar_kandidat'), $fileName);
                }
            }
            $osis->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('kandidat');
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
        $validated = $request->validate([
            'ketua' => 'required',
            'wakil' => 'required',
            'periode' => 'required',
            'quote' => 'required',
            'urut' => 'required',
            'elm1' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $editkelas = KandidatModel::findOrFail($id);
            $editkelas->id_ketua = $request->ketua;
            $editkelas->id_wakil = $request->wakil;
            $editkelas->no_urut = $request->urut;
            $editkelas->id_periode = $request->periode;
            $editkelas->quote = $request->quote;
            $editkelas->visi_misi = $request->elm1;
            $editkelas->user_updated =  Auth::user()->id;
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $editkelas->avatar_kandidat = $fileName;
                $request->avatar->move(public_path('avatar_kandidat'), $fileName);
            }
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
