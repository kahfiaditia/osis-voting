<?php

namespace App\Http\Controllers;

use App\Models\PengikutModel;
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
        ];

        return view('pengikut.create')->with($data);
    }

    public function data_kegiatan()
    {
        $result = DB::table('table_jadwal_hari')
            ->select(
                'table_jadwal_hari.id as id',
                'table_jadwal_hari.id_kegiatan',
                'ekstrakurikuler.id as ekstrakurikuler_id',
                'ekstrakurikuler.name as ekstrakurikuler_name',
                'users.id as user_id',
                'users.name as user_name'
            )
            ->join('ekstrakurikuler', 'table_jadwal_hari.id_kegiatan', '=', 'ekstrakurikuler.id')
            ->join('users', 'table_jadwal_hari.id_pembina', '=', 'users.id')
            ->groupBy('table_jadwal_hari.id_kegiatan')
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

    public function cari_siswa()
    {
        $result = DB::table('users')
            ->where('roles', '=', 'siswa')
            ->whereNull('deleted_at')
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

    public function simpan_pengikut(Request $request)
    {
        DB::beginTransaction();
        try {
            $datapengikut = $request->input('datapengikut');

            // Validate that each id_pengikut follows only one id_ekstra
            foreach ($datapengikut as $data) {
                $id_ekstra = $data['kegiatan'];
                $id_pengikut = $data['nis'];

                // Check if the combination already exists
                $existingRecord = PengikutModel::where('id_ekstra', $id_ekstra)
                    ->where('id_pengikut', $id_pengikut)
                    ->first();

                if ($existingRecord) {
                    DB::rollBack();
                    return response()->json([
                        'code' => 400,
                        'message' => 'Siswa sudah mengikuti Ektra Kulikuler ini',
                    ]);
                }
            }

            // Insert data into the database
            foreach ($datapengikut as $data) {
                PengikutModel::create([
                    'id_ekstra' => $data['kegiatan'],
                    'id_pengikut' => $data['nis'],
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
