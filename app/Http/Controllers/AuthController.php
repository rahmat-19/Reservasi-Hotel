<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class AuthController extends Controller
{
    public function login()
    {
        return view('authantication.login', ['title' => 'Login']);
    }
    public function register()
    {
        return view('authantication.register', ['title' => 'Registrasi']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->level !== 'pelanggan') {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registrasi(Request $request)
    {
        $validationData = $request->validate([
            'nama' => 'required',
            'email' => 'email:rfc,dns|unique:users',
            'no_hp' => 'nullable|unique:pelanggans|string|min:11|max:14',
            'alamat' => 'required|string|',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        /* Sotre data user */
        $user = new User();
        $user->email = $validationData['email'];
        $user->password = bcrypt($validationData['password']);
        $user->save();

        /* Store data pelanggan */
        $penlanggan = new Pelanggan();
        $penlanggan->nama_lengkap = $validationData['nama'];
        $penlanggan->no_hp = $validationData['no_hp'];
        $penlanggan->alamat = $validationData['alamat'];
        $user->pelanggans()->save($penlanggan);

        $result = $user->save();
        if ($result) {
            return redirect(Route('login'))->with('success', 'You Have Successfully Created an Account');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
