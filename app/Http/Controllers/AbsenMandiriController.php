<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\AbsenTemModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenMandiriController extends Controller
{
    protected $title = 'Absensi';
    protected $menu = 'Absensi Mandiri';
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
            'label' => 'Absen Mandiri',
            // 'list' => JadwalKegiatanModel::whereNull('deleted_at')->get(),
            'lists' => $list,
        ];
        return view('absensi_mandiri.absen_mandiri')->with($data);
    }

    public function data_hadir(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = json_decode($request->getContent(), true);
            dd($data);

            $user_id = $data['user_id'];
            $hari = $data['hari'];
            $kegiatan = $data['kegiatan'];
            $jadwal = $data['jadwal'];
            $tanggal = $data['tanggal'];

            $absenmandiri = new AbsenTemModel();
            $absenmandiri->id_kegiatan = $kegiatan;
            $absenmandiri->id_siswa =  $user_id;
            $absenmandiri->id_hari = $hari;
            $absenmandiri->id_jadwal = $jadwal;
            $absenmandiri->tanggal = $tanggal;
            $absenmandiri->kehadiran = '';
            $absenmandiri->keterangan = '';
            $absenmandiri->user_created = '';

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/kegiatan');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
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
        //
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
}
