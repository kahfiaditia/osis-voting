<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\PembinaModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PembinaController extends Controller
{
    protected $title = 'Ekstra Kurikuler';
    protected $menu = 'Pembina';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->where('roles', 'guru')
            ->whereNull('deleted_at')
            ->get();

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Data Pembina',
            'pembina' => $users,
        ];

        return view('pembina.data')->with($data);
    }

    public function get_data_pembina(Request $request)
    {
        $userdata = DB::table('users')
            ->where('roles', '=', 'pembina')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('roles', 'like', '%' . $search . '%');
                // ->orWhere('id_supplier', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%')
                        ->orWhere('roles', 'like', '%' . $search . '%');
                    // ->orWhere('id_supplier', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $userdata->where('name', '=', $name);
            }
            if ($request->get('email') != null) {
                $email = $request->get('email');
                $userdata->where('email', '=', $email);
            }
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $userdata->where('name', '=', $name);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'pembina.a')
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
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Data Pembina',
        ];

        return view('pembina.input')->with($data);
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
            'nama' => 'required',
            'nis' => 'required|unique:users,nis',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $osis = new User();
            $osis->name = $request->nama;
            $osis->email = $request->email;
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $osis->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $osis->password =  bcrypt('12345');
            $osis->pin = 1234;
            $osis->nis = $request->nis ?? null;
            $osis->address = $request->alamat;
            $osis->phone = $request->telepon;
            $osis->roles = $request->role;
            $osis->class_id = $request->kelas;
            $osis->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pembina');
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
     * @param  \App\Models\PembinaModel  $pembinaModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembinaModel  $pembinaModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Data Pembina',
            'data' => User::findOrfail($id),
        ];

        return view('pembina.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembinaModel  $pembinaModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:users,nis',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $pembina = User::findOrFail($id);
            $pembina->name = $request->nama;
            $pembina->email = $request->email;
            $pembina->password =  bcrypt('12345');
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $pembina->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $pembina->pin =  1234;
            $pembina->nis =  $request->nis;
            $pembina->address = $request->alamat;
            $pembina->phone = $request->telepon;
            $pembina->roles = $request->role;
            $pembina->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pembina');
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
     * @param  \App\Models\PembinaModel  $pembinaModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
