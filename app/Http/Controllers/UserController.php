<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::whereNotIn('level', ['admin', 'pelanggan'])->get();
        $title = 'Users';
        return view('dashboard.users.index', compact('datas', "title"));
    }

    public function detail(User $user)
    {
    }

    public function edit(User $user)
    {
    }

    public function create(Request $request)
    {
        $validationData = $request->validate([
            'nama' => 'required|string',
            'level' => 'required|string|in:admin,bendahar,pemilik',
            'email' => 'email:rfc,dns|unique:users',
            'aktif' => 'nullable|integer',
            'no_hp' => 'nullable|unique:pelanggans|string|min:11|max:14',
            'alamat' => 'required|string|',
            'jabatan' => 'required|string|in:administrator,bendahara,pemilik',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        /* Sotre data user */
        $user = new User();
        $user->email = $validationData['email'];
        $user->password = bcrypt($validationData['password']);
        if ($request->aktif) {
            $user->aktif = $validationData['aktif'];
        }
        $user->save();

        /* Store data pelanggan */
        $karyawan = new Karyawan();
        $karyawan->nama_lengka = $validationData['nama'];
        $karyawan->no_hp = $validationData['no_hp'];
        $karyawan->alamat = $validationData['alamat'];
        $karyawan->jabatan = $validationData['jabatan'];
        if ($request->hasFile('foto')) {
            # code...
        }
        $user->karyawans()->save($karyawan);

        $result = $user->save();
        if ($result) {
            return redirect(Route('user.index'))->with('success', 'You Have Successfully Created an Account.');
        } else {
            return redirect(Route('user.index'))->with('error', 'You Have Failed Create an Account.');
        }
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $validationData = $request->validate([
            'nama_lengka' => 'required|string',
            'alamat' => 'required|string|',
            'no_hp' => 'nullable|unique:pelanggans|string|min:11|max:14',
            'jabatan' => 'required|string|in:administrator,bendahara,pemilik'
        ]);
        $result = $karyawan->update($validationData);
        if ($result) {
            return redirect(Route('user.index'))->with('success', 'User Updated Successfully.');
        } else {
            return redirect(Route('user.index'))->with('error', 'User Updated Failed.');
        }
    }

    public function delete($id)
    {
        $result = User::destroy($id);
        if ($result) {
            return redirect()->back()->with('success', 'User Delete Successfully.');
        } else {
            return redirect()->back()->with('error', 'User Delete Failed.');
        }
    }
}
