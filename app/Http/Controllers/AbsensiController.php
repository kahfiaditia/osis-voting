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
            ->where('table_jadwal_hari.id_kegiatan', '=', $id)
            ->first();

        // dd($list);

        $userdata = DB::table('table_pengikut_data')
            ->join('users', 'table_pengikut_data.id_pengikut', '=', 'users.id')
            ->join('ekstrakurikuler', 'table_pengikut_data.id_ekstra', '=', 'ekstrakurikuler.id')
            ->select('users.id as id_user', 'users.nis', 'users.name', 'table_pengikut_data.id_pengikut', 'table_pengikut_data.id_ekstra as id_kegiatan', 'ekstrakurikuler.name as nama_ekstrakurikuler')
            ->where('table_pengikut_data.id_ekstra', '=',  $id)
            ->get();

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'kegiatan' => 'Ekstrakulikuler',
            'absensinya' => $userdata,
            'data_kegiatan' => $id,
            'absen_kegiatan' =>  $list,

        ];
        return view('absensi.input_absen')->with($data);
    }

    public function simpan(Request $request)
    {
        // dd($request->data);
        DB::beginTransaction();
        try {

            // Data absensi yang dikirim dari frontend
            $data_absensi = $request->data;

            foreach ($data_absensi as $key => $value) {
                // dd($data_absensi);
                $tanggal = Carbon::now();
                // Cek apakah hari ini sesuai dengan jadwal kegiatan
                $tanggalHariIni = date("Y-m-d");
                $kodeHariIni = date('N', strtotime($tanggalHariIni));

                // Cek apakah ada jadwal kegiatan untuk hari ini (kode hari ini)
                $cekJadwal = DB::table('table_jadwal_hari')
                    ->where('id_kegiatan', $value['id_kegiatan'])
                    ->where('id_hari', $kodeHariIni)
                    ->get();

                if ($cekJadwal->isEmpty()) {
                    DB::rollBack();
                    return response()->json([
                        'code' => 400,
                        'message' => 'Hari ini tidak sesuai dengan jadwal kegiatan.',
                    ]);
                }

                foreach ($cekJadwal as $cekhari) {
                    $id_pembina = $cekhari->id_pembina;
                    $id_kegiatan = $cekhari->id_kegiatan;
                    $id_hari = $cekhari->id_hari;

                    $cekabsensi = HasilAbsensiModel::where('id_kegiatan',  $id_kegiatan)
                        ->where('id_hari', $id_hari)
                        ->where('id_siswa', $value['id_user'])
                        ->whereDate('tanggal', $tanggal)
                        ->first();

                    if ($cekabsensi == null) {
                        // Jika data tidak ada, buat data baru
                        $hasilabsensi = new HasilAbsensiModel();
                        $hasilabsensi->id_kegiatan = $value['id_kegiatan'];
                        $hasilabsensi->id_siswa = $value['id_user'];
                        $hasilabsensi->id_hari = $value['id_hari'];
                        $hasilabsensi->tanggal =  $tanggalHariIni;
                        $hasilabsensi->status = $value['absensi'];
                        $hasilabsensi->keterangan = $value['keterangan'];
                        $hasilabsensi->user_created = Auth::user()->id;
                        $hasilabsensi->created_at = Carbon::now();
                        $hasilabsensi->save();
                    } else {
                        // Jika data sudah ada, update data tersebut
                        $cekabsensi->status = $value['absensi'];
                        $cekabsensi->keterangan = $value['keterangan'];
                        $cekabsensi->user_updated = Auth::user()->id;
                        $cekabsensi->updated_at = Carbon::now();
                        $cekabsensi->save();
                    }
                }
            }

            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Input Data',
            ]);
        } catch (\Throwable $err) {
            // Rollback transaksi database jika terjadi kesalahan
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

    public function cariBarcode(Request $request)
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
}
