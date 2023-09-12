<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ExtraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExtraController extends Controller
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
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Data Ekstrakurikuler',
            'kegiatan' => ExtraModel::whereNull('deleted_at')->get(),
        ];

        return view('kurikuler.data')->with($data);
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
            'label' => 'Data Ekstrakurikuler',
        ];

        return view('kurikuler.input')->with($data);
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
        ]);
        $status = $request->has('status') ? 1 : 2;

        DB::beginTransaction();

        try {

            $input = new ExtraModel();
            $input->kode = $request->kode;
            $input->name = $request->nama;
            $input->deskripsi = $request->deskripsi;
            $input->status = $status;
            $input->user_created = Auth::user()->id;
            $input->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('kegiatan');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExtraModel  $extraModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExtraModel  $extraModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Edit Data',
            'edit' => ExtraModel::findOrFail($id),
        ];

        return view('kurikuler.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExtraModel  $extraModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
        ]);
        $status = $request->has('status') ? 1 : 2;

        DB::beginTransaction();

        try {

            $kegiatan = ExtraModel::findOrFail($id);
            $kegiatan->kode = $request->kode;
            $kegiatan->name = $request->nama;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->status = $status;
            $kegiatan->user_updated =  Auth::user()->id;
            $kegiatan->save();

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExtraModel  $extraModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
