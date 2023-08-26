<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Imports\UserImport;
use App\Models\ClasessModel;
use App\Models\TemporaryModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $title = 'Evoting';
    protected $menu = 'Evoting';
    protected $siswa = 'Siswa';
    protected $guru = 'Guru';
    protected $admin = 'administrator';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function halaman()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Upload User',
            'label' => 'Siswa Import',
        ];
        return view('user.halaman')->with($data);
    }

    public function gagal_import()
    {
        return view('user.gagal');
    }

    public function uploadExcel(Request $request)
    {

        try {
            $request->validate([
                'excelFile' => 'required|mimes:xls,xlsx',
            ]);

            $file = $request->file('excelFile');

            $import = new UserImport();
            $hasil = $import->toArray($file);

            DB::beginTransaction();

            for ($rowIndex = 1; $rowIndex < count($hasil[0]); $rowIndex++) {
                $name = $hasil[0][$rowIndex][1];
                $email = $hasil[0][$rowIndex][2];
                $nis = $hasil[0][$rowIndex][5];
                $nik = $hasil[0][$rowIndex][6];
                $alamat = $hasil[0][$rowIndex][7];
                $tlp = $hasil[0][$rowIndex][8];

                TemporaryModel::create([
                    'name' => $name,
                    'email' => $email,
                    'nis' => $nis,
                    'nik' => $nik,
                    'address' => $alamat,
                    'phone' => $tlp,
                ]);
            }

            DB::commit();
            return redirect()->route('pengguna.hasil_import');
        } catch (\Throwable $err) {
            DB::rollBack();
            return redirect()->route('pengguna.gagal_import');
        }
    }

    public function hasil_import()
    {
        $importedData = TemporaryModel::all();

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Siswa',
            'label' => 'Hasil Import',
            'importedData' => $importedData
        ];

        return view('user.data_import')->with($data);
    }

    public function hapus_semua()
    {
        TemporaryModel::truncate(); // Menghapus semua data dari TemporaryModel
        return redirect()->route('pengguna.halaman')->with('success', 'Semua data berhasil dihapus');
    }

    public function simpanUserAjax(Request $request)
    {
        // dd($request->datasiswa);
        $datasiswa = $request->datasiswa;
        DB::beginTransaction();
        try {
            foreach ($datasiswa as $item) {
                DB::table('users')->insert([
                    'name' => $item['nama'],
                    'pin' => $item['pin'],
                    'password' => bcrypt($item['password']),
                    'email' => $item['email'],
                    'nis' => $item['nis'],
                    'address' => $item['address'],
                    'phone' => $item['phone'],
                    'roles' => "siswa",
                ]);
            }

            TemporaryModel::truncate();

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

    public function get_data_guru(Request $request)
    {
        $userdata = DB::table('users')
            // ->select('name', 'email', 'users.id', 'nis', 'roles', 'class_name', 'class_level')
            // ->leftJoin('clasess', 'clasess.id', 'users.class_id')
            ->where('roles', '=', 'guru')
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
            ->addColumn('action', 'user.guru.buttonguru')
            ->rawColumns(['action'])
            ->make(true);
    }


    public function get_data_siswa(Request $request)
    {
        $usersiswa = DB::table('users')
            ->select('name', 'email', 'address', 'phone', 'users.id', 'nis', 'roles', 'class_name', 'class_level')
            ->leftJoin('clasess', 'clasess.id', 'users.class_id')
            ->where('roles', '=', 'siswa')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $usersiswa->where(function ($where) use ($search) {
                $where
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('roles', 'like', '%' . $search . '%');
                // ->orWhere('id_supplier', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $usersiswa->where(function ($where) use ($search) {
                    $where
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('roles', 'like', '%' . $search . '%');
                    // ->orWhere('id_supplier', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $usersiswa->where('name', '=', $name);
            }
            if ($request->get('email') != null) {
                $email = $request->get('email');
                $usersiswa->where('email', '=', $email);
            }
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $usersiswa->where('name', '=', $name);
            }
        }

        return DataTables::of($usersiswa)
            ->addColumn('class', function ($usersiswa) {
                if ($usersiswa->class_name) {
                    $class = $usersiswa->class_name . ' - ' . $usersiswa->class_level;
                } else {
                    $class = '-';
                }
                return $class;
            })
            ->addColumn('action', 'user.siswa.akse')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_data_administrator(Request $request)
    {
        $userdata = DB::table('users')
            ->where('roles', '=', 'administrator')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
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
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
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
            ->addColumn('action', 'user.administrator.aksiall')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function cari_data_all(Request $request)
    {
        $userdata = DB::table('users')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
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
                        ->orWhere('nis', 'like', '%' . $search . '%')
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
            ->addColumn('action', 'user.aksiall')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->siswa,
            'label' => $this->siswa,
        ];
        return view('user.siswa.list')->with($data);
    }

    public function alluser()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
        ];
        // return view('user.alluser')->with($data);
        return view('user.list_data_all')->with($data);
    }

    public function data_guru()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => "Data Guru",
        ];

        return view('user.guru.data_guru')->with($data);
    }

    public function edit_guru($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => 'Guru',
            'label' => 'Edit Guru',
            'data' => User::findOrFail($id),

        ];
        return view('user.guru.edit_guru')->with($data);
    }

    public function admin()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => "Data Admin",
        ];

        return view('user.administrator.admin')->with($data);
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
            'label' => $this->guru,
            'kelas' => ClasessModel::All()
        ];
        return view('user.guru.input_guru')->with($data);
    }

    // public function tambah_admin(Request $request)
    // {
    //     $data = [
    //         'title' => $this->title,
    //         'menu' => "Admin",
    //         'label' => "Admin",

    //     ];
    //     return view('user.administrator.tambah_administrator')->with($data);
    // }

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
            'email' => 'required|unique:users,email',
            'telepon' => 'required|unique:users,phone',
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
            if ($request->flag == 'tambah_siswa') {
                return redirect('/pengguna');
            } else {
                return redirect('/alluser');
            }
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    public function tambah_siswa(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->siswa,
            'label' => $this->siswa,
            'kelas' => ClasessModel::All()
        ];
        return view('user.siswa.tambah_siswa')->with($data);
    }

    public function tambah_administrator(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => "admin",
            'label' => "admin",
        ];
        return view('user.administrator.tambah_administrator')->with($data);
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
            'label' => $this->menu,
            'data' => User::findOrFail($id),
            'kelas' => ClasessModel::all(),
        ];
        return view('user.edit')->with($data);
    }

    public function edit_admin($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => 'Administrator',
            'label' => 'Administrator',
            'data' => User::findOrFail($id),

        ];
        return view('user.administrator.edit_admin')->with($data);
    }

    public function edit_siswa($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => 'Siswa',
            'label' => 'Siswa',
            'data' => User::findOrFail($id),
            'kelas' => ClasessModel::all(),
        ];
        return view('user.siswa.edit_siswa')->with($data);
    }

    public function update_edit_siswa(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $osis1 = User::findOrFail($id);
            $osis1->name = $request->nama;
            $osis1->email = $request->email;
            $osis1->password =  bcrypt('12345');
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $osis1->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $osis1->pin =  1234;
            $osis1->nis =  $request->nis ?? null;
            $osis1->address = $request->alamat;
            $osis1->phone = $request->telepon;
            $osis1->roles = $request->role;
            $osis1->class_id = $request->kelas;
            $osis1->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pengguna');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
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
        DB::beginTransaction();
        try {
            $osis1 = User::findOrFail($id);
            $osis1->name = $request->nama;
            $osis1->email = $request->email;
            $osis1->password =  bcrypt('12345');
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $osis1->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $osis1->pin =  1234;
            $osis1->nis =  $request->nis ?? null;
            $osis1->address = $request->alamat;
            $osis1->phone = $request->telepon;
            $osis1->roles = $request->role;
            $osis1->class_id = $request->kelas;
            $osis1->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/alluser');
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
            $hapus = User::findorfail($id);
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

    public function profil()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'profil' => User::where('id', Auth::user()->id)->first()
        ];

        return view('user.profil.profil')->with($data);
    }


    public function updateProfil(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|max:50',
            'nis' => 'max:15',
            'pin' => 'required|numeric|max:9999',
            'role' => 'required|in:guru,siswa,Administrator',
            'nis' => 'max:15',
            'password' => 'nullable|max:60',
            'alamat' => 'max:50',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->nis = $request->nis ?? 0;
            $user->pin = $request->pin;
            $user->roles = $request->role;
            $user->phone = $request->phone;
            $user->nik = 0;
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->address = $request->alamat;
            $user->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/profil');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    public function reset_password(Request $request, $id)
    {
        $user = User::find($request->id);
        // dd($user);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        $newPassword = $user->nis . now()->format('dm');
        // dd($newPassword);
        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return response()->json(['message' => 'Password reset berhasil.']);
    }
}
