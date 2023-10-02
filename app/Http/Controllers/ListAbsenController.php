<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ExtraModel;
use App\Models\HasilAbsensiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListAbsenController extends Controller
{
    protected $title = 'Absensi';
    protected $menu = 'Data Absensi';
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
            'jenis' => ExtraModel::whereNull('deleted_at')->get(),
        ];

        return view('list_absensi.data')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data_jadwal(Request $request)
    {
        $kegiatan = $request->id_kegiatan;
        $result = DB::table('table_jadwal_hari')
            ->select('id_kegiatan', 'id_hari', 'nama_hari')
            ->join('table_hari', 'table_hari.id', '=', 'table_jadwal_hari.id_hari')
            ->where('id_kegiatan', $kegiatan)
            ->get(); // Gunakan get() untuk mengambil data

        if ($result->isEmpty()) { // Periksa jika hasil kosong
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'data' => $result,
            ]);
        }
    }

    public function getDataTanggal(Request $request)
    {
        $idHari = $request->id_hari;
        $idKegiatan = $request->id_kegiatan;

        // dd($tanggal);
        $tanggalData = DB::table('table_absensi_data')
            ->select('tanggal', 'id_hari', 'id_kegiatan', 'id_siswa', 'table_absensi_data.status', 'keterangan')
            ->where('id_kegiatan', $idKegiatan)
            ->where('id_hari', $idHari)
            ->groupBy('tanggal')
            ->get();

        if ($tanggalData) {
            return response()->json([
                'code' => 200,
                'data' => $tanggalData,
            ]);

            // return $this->filterData($request);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function data_absen(Request $request)
    {

        $idKegiatan = $request->id_kegiatan;
        $idHari = $request->id_hari;
        $tanggal = $request->tanggal;

        $filteredData = DB::table('table_absensi_data')
            ->select('table_absensi_data.id', 'tanggal', 'id_hari', 'id_kegiatan', 'ekstrakurikuler.name as kegiatan', 'table_hari.nama_hari as hari', 'users.nis as nis', 'id_siswa', 'users.name as siswa', 'table_absensi_data.status', 'keterangan')
            ->join('users', 'table_absensi_data.id_siswa', '=', 'users.id')
            ->join('ekstrakurikuler', 'table_absensi_data.id_kegiatan', '=', 'ekstrakurikuler.id')
            ->join('table_hari', 'table_absensi_data.id_hari', '=', 'table_hari.id')
            ->where('id_kegiatan', $idKegiatan)
            ->where('id_hari', $idHari)
            ->where('tanggal', $tanggal)
            ->get();

        if ($filteredData) {
            return response()->json([
                'code' => 200,
                'data' => $filteredData,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function create()
    {
    }

    public function absen_edit()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'jenis' => ExtraModel::whereNull('deleted_at')->get(),
        ];

        return view('list_absensi.edit_data')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    public function edit_absen_hasil($id)
    {
        // dd($id);

        $filteredData = DB::table('table_absensi_data')
            ->select('table_absensi_data.id', 'tanggal', 'id_hari', 'id_kegiatan', 'ekstrakurikuler.name as kegiatan', 'table_hari.nama_hari as hari', 'users.nis as nis', 'id_siswa', 'users.name as siswa', 'table_absensi_data.status', 'keterangan')
            ->join('users', 'table_absensi_data.id_siswa', '=', 'users.id')
            ->join('ekstrakurikuler', 'table_absensi_data.id_kegiatan', '=', 'ekstrakurikuler.id')
            ->join('table_hari', 'table_absensi_data.id_hari', '=', 'table_hari.id')
            ->where('table_absensi_data.id', $id)
            ->first();

        // dd($filteredData);

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'hasil' =>  $filteredData,

        ];

        return view('list_absensi.form_edit')->with($data);
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

        // dd($request->kehadiran);
        DB::beginTransaction();
        try {
            $hadir = $request->kehadiran;
            // dd($request->kehadiran);
            $invpinjaman = HasilAbsensiModel::findOrFail($id);
            // dd($invpinjaman);
            $invpinjaman->status =  $hadir;
            $invpinjaman->user_created =  Auth::user()->id;
            $invpinjaman->updated_at =  Carbon::now();
            $invpinjaman->save();


            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/absen_edit');
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
        //
    }
}
