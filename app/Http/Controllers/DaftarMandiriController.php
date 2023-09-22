<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ExtraModel;
use App\Models\PengikutModel;
use Carbon\Carbon;
use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DaftarMandiriController extends Controller
{
    protected $title = 'Ekstra Kurikuler';
    protected $menu = 'Ekstra Kurikuler';
    protected $extra = 'Pendaftaran Kegiatan';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "
        SELECT
        ek.id AS id_ekstrakurikuler,
            ek.name AS Kegiatan,
            (
                SELECT u.name
                FROM table_jadwal_hari tj
                LEFT JOIN users u ON tj.id_pembina = u.id
                WHERE tj.id_kegiatan = ek.id
                LIMIT 1
            ) AS Pembina,
            GROUP_CONCAT(th.nama_hari ORDER BY th.id SEPARATOR ', ') AS Hari
        FROM
            ekstrakurikuler ek
        LEFT JOIN
            table_jadwal_hari tj ON tj.id_kegiatan = ek.id
        LEFT JOIN
            table_hari th ON tj.id_hari = th.id
        GROUP BY
            ek.id
        ORDER BY
            ek.id;
        ";

        $result = DB::select(DB::raw($query));


        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'extra' => $this->extra,
            'label' => 'Data Ekstrakurikuler',
            'jadwal' => $result,
        ];

        // Cek apakah pengguna sudah mengikuti kegiatan dan kirim flag ke view
        $cekvalidasi['alreadyJoinedActivities'] = PengikutModel::where('id_pengikut', Auth::user()->id)
            ->whereIn('id_ekstra', collect($result)->pluck('id_ekstrakurikuler'))
            ->pluck('id_ekstra')
            ->toArray();

        return view('daftar.list_data', compact('data', 'cekvalidasi'));
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

    public function daftar_kegiatan(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->dataId);

            $existingRecord = PengikutModel::where('id_ekstra', $request->dataId)
                ->where('id_pengikut', Auth::user()->id)
                ->first();

            if ($existingRecord) {
                DB::rollBack();
                AlertHelper::addAlert(false);
                return back();
            }

            PengikutModel::create([
                'id_ekstra' => $request->dataId,
                'id_pengikut' =>  Auth::user()->id,
                'user_created' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/daftar_mandiri');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

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
