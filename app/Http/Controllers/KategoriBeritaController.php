<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{

    public function index()
    {
        $datas = KategoriBerita::all();
        $title = 'Kategori Berita';
        return view('dashboard.kategori-berita.index', compact('datas', 'title'));
    }

    public function edit(KategoriBerita $kbrt)
    {
        return response()->json($kbrt);
    }
    public function create(Request $request)
    {
        $validateDate = $request->validate([
            'kategori_berita' => 'required',
        ]);

        $result = KategoriBerita::create($validateDate);
        if ($result) {
            return redirect()->back()->with('success', 'You Have Successfully Created kategori.');
        } else {
            return redirect()->back()->with('error', 'You Have Failed Create Kategori.');
        }
    }

    public function update(KategoriBerita $kbrt, Request $request)
    {
        $validateDate = $request->validate([
            'kategori_berita' => 'required'
        ]);

        $result = $kbrt->update($validateDate);
        if ($result) {
            return redirect(Route('kbrt.index'))->with('success', 'Kategori Berita Updated Successfully.');
        } else {
            return redirect(Route('kbrt.index'))->with('error', 'Kategori Berita Updated Failed.');
        }
    }

    public function destroy(KategoriBerita $kategoriBerita)
    {
        $result = $kategoriBerita->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Kategori Berita Delete Successfully.');
        } else {
            return redirect()->back()->with('error', 'Kategori Berita Delete Failed.');
        }
    }
}
