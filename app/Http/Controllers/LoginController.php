<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $title = 'E-Votting';
    protected $menu = 'login';
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
            'submenu' => 'login',
            'label' => 'login',
        ];
        return view('login.login')->with($data);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required',
            'aktif' => '0',
        ]);

        // login password harus bcrpt baru bisa masuk auth::attempt
        if (Auth::attempt($credentials)) {


            if (Auth::user()->roles == 'Administrator') {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else if (Auth::user()->roles == 'guru') {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else if (Auth::user()->roles == 'siswa') {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('loginError', 'Login Fail!');
            }
        }
        return back()->with('loginError', 'Login Fail!');
    }

    public function recovery(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'recovery',
            'type' => 'recovery',
            'subject' => 'Reset Password',
            'p' => 'E-Votting',
            'submit' => 'Reset',
        ];
        return view('login.recovery')->with($data);
    }

    public function reverify(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'reverify',
            'type' => 'reverify',
            'subject' => 'Reverify Email',
            'p' => 'E-Votting',
            'submit' => 'Reverify',
        ];
        return view('login.recovery')->with($data);
    }

    public function logout(Request $request)
    {
        User::where(['id' => Auth::user()->id])->update([
            'date_login' => null,
            'date_logout' => Carbon::now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
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
