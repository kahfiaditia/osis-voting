<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ExtraModel;
use App\Models\JadwalKegiatanModel;
use App\Models\PengikutModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengikutController extends Controller
{
    protected $title = 'Ekstra Kurikuler';
    protected $menu = 'Ekstra Kurikuler';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Input Ekstrakurikuler',
            'pilihan' => ExtraModel::all(),
        ];

        return view('pengikut.create')->with($data);
    }

    public function data_kegiatan()
    {
        $result = DB::table('table_jadwal_hari as j')
            ->select('j.id_kegiatan as id', 'e.name as ekstrakurikuler_name', 'u.name as user_name')
            ->join('ekstrakurikuler as e', 'j.id_kegiatan', '=', 'e.id')
            ->join('users as u', 'j.id_pembina', '=', 'u.id')
            ->groupBy('j.id_kegiatan')
            ->get();

        if (count($result) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function cari_siswa(Request $request)
    {
        $id = $request->kegiatan;

        if ($id) {
            $result = User::select('users.id as id', 'users.nis as nis', 'users.name', 'users.email', 'users.roles')
                ->leftJoin('table_pengikut_data', function ($join) use ($id) {
                    $join->on('users.id', '=', 'table_pengikut_data.id_pengikut')
                        ->where('table_pengikut_data.id_ekstra', '=', $id);
                })
                ->whereNull('table_pengikut_data.id_pengikut')
                ->where('users.roles', 'siswa')
                ->get();

            if (count($result) > 0) {
                return response()->json([
                    'code' => 200,
                    'data' => $result,
                ]);
            } else {
                return response()->json([
                    'code' => 400,
                    'data' => null,
                ]);
            }
        } else {
            // Handle the case where $id is not defined (e.g., return an error response or set a default value).
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function getSiswaByExtra($id)
    {
        // dd($id);
        $siswa = DB::table('table_pengikut_data as pd')
            ->select('e.id as id_ekstra', 'e.name as nama_ekstrakurikuler', 'pd.id as id_pengikut', 'u.nis as data_nis', 'u.name as nama_pengikut')
            ->leftJoin('ekstrakurikuler as e', 'pd.id_ekstra', '=', 'e.id')
            ->leftJoin('users as u', 'pd.id_pengikut', '=', 'u.id')
            ->where('e.id', $id)
            ->groupBy('e.id', 'e.name', 'pd.id', 'u.name')
            ->orderBy('e.id')
            ->get();

        return response()->json(['data' => $siswa]);
    }

    public function simpan_pengikut(Request $request)
    {
        // dd($request->tableData);

        DB::beginTransaction();
        try {
            $tableData = $request->input('tableData');

            foreach ($tableData as $data) {

                $id_siswa = $data['id'];
                $nis = $data['nis'];
                $nama_siswa = $data['nama_siswa'];
                $kode_kegiatan = $data['kode_kegiatan'];
                $nama_kegiatan = $data['nama_kegiatan'];


                $existingRecord = PengikutModel::where('id_ekstra', $kode_kegiatan)
                    ->where('id_pengikut', $id_siswa)
                    ->first();

                if ($existingRecord) {
                    // DB::rollBack();
                    return response()->json([
                        'code' => 400,
                        'message' => 'Siswa sudah mengikuti Ektra Kulikuler ini',
                    ]);
                }
            }

            foreach ($tableData as $data) {
                PengikutModel::create([
                    'id_ekstra' => $data['kode_kegiatan'],
                    'id_pengikut' => $data['id'],
                    'user_created' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Input Data',
            ]);
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return response()->json([
                'code' => 404,
                'message' => 'Gagal Input Data',
            ]);
        }
    }

    public function scanBarcode1(Request $request)
    {

        $code = 400;
        $id = null;
        $name = null;
        $nis = null;
        $class_id = null;
        $type = null;
        $val = 0;


        $data = User::where('nis', $request->nis)->first();
        if ($data) {
            $id = $data->id;
            $name = $data->name;
            $nis = $data->nis;
            $class_id = $data->class_id;
            $type = $data->roles;
            $code = 200;
            $val = $val + 1;
        }


        return response()->json([
            'code' => $code,
            'id' => $id,
            'name' => $name,
            'nis' => $nis,
            'class_id' => $class_id,
            'type' => $type,
            'val' => $val,
        ]);
    }

    public function cekDuplicate(Request $request)
    {
        $tableData = $request->input('tableData');

        $duplicateData = [];
        foreach ($tableData as $data) {
            $existingRecord = PengikutModel::where('id_ekstra', $data['kode_kegiatan'])
                ->where('id_pengikut', $data['id'])
                ->first();

            if ($existingRecord) {
                $duplicateData[] = [
                    'nama_siswa' => $data['nama_siswa'],
                    'nama_kegiatan' => $data['nama_kegiatan'],
                ];
            }
        }

        return response()->json(['code' => 200, 'duplicateData' => $duplicateData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengikutModel  $pengikutModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengikutModel  $pengikutModel
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
     * @param  \App\Models\PengikutModel  $pengikutModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengikutModel  $pengikutModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
