<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\HasilAbsensiModel;
use App\Models\JadwalKegiatanModel;
use App\Models\PengikutModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    protected $title = 'Absensi';
    protected $menu = 'Absensi Ekstrakulikuler';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('N'); // 'N' mengembalikan nomor hari (1 = Senin, 2 = Selasa, dst.)

        $list = DB::table('table_jadwal_hari')
            ->select(
                'table_jadwal_hari.*',
                'table_hari.nama_hari',
                'users.name as nama_pembina',
                'ekstrakurikuler.name as nama_kegiatan'
            )
            ->join('table_hari', 'table_jadwal_hari.id_hari', '=', 'table_hari.id')
            ->leftJoin('users', 'table_jadwal_hari.id_pembina', '=', 'users.id')
            ->leftJoin('ekstrakurikuler', 'table_jadwal_hari.id_kegiatan', '=', 'ekstrakurikuler.id')
            ->whereNull('table_jadwal_hari.deleted_at')
            ->where('table_hari.kode', '=', $today)
            ->get();

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'kegiatan' => 'Ekstrakulikuler',
            // 'list' => JadwalKegiatanModel::whereNull('deleted_at')->get(),
            'list' => $list,
        ];
        return view('absensi.list_jadwal')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $userdata = DB::table('table_pengikut_data')
            ->join('users', 'table_pengikut_data.id_pengikut', '=', 'users.id')
            ->select('users.id as id_user', 'users.nis', 'users.name', 'table_pengikut_data.id_pengikut', 'table_pengikut_data.id_ekstra as id_kegiatan')
            ->where('table_pengikut_data.id_ekstra', $id)
            ->get();

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'kegiatan' => 'Ekstrakulikuler',
            'absensinya' => $userdata,
            'data_kegiatan' => $id,

        ];
        return view('absensi.input_absen')->with($data);
    }

    public function simpan(Request $request)
    {
        // dd($request->data);
        DB::beginTransaction();
        try {
            $data_absensi = $request->data;
            foreach ($data_absensi as $key => $value) {
                $hasilabsensi = new HasilAbsensiModel();
                $hasilabsensi->id_kegiatan = $value['id_kegiatan'];
                $hasilabsensi->id_siswa = $value['id_user'];
                $hasilabsensi->status = $value['absensi'];
                $hasilabsensi->keterangan = $value['keterangan'];
                $hasilabsensi->user_created =  Auth::user()->id;
                $hasilabsensi->created_at = Carbon::now();
                $hasilabsensi->save();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function barcode_absensi()
    {
        // dd($id);

        // $data = [
        //     'title' => $this->title,
        //     'menu' => $this->menu,
        //     'kegiatan' => 'Ekstrakulikuler',
        //     'label' => 'Data',
        // ];
        // return view('absensi.absensi_barcode')->with($data);
    }
}
