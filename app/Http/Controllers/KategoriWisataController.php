<?php

namespace App\Http\Controllers;

use App\Models\KategoriWisata;
use Illuminate\Http\Request;

class KategoriWisataController extends Controller
{

    public function edit(KategoriWisata $kwst)
    {
        return response()->json($kwst);
    }
    public function create(Request $request)
    {
        $validateDate = $request->validate([
            'kategori_wisata' => 'required',
        ]);

        $result = KategoriWisata::create($validateDate);
        if ($result) {
            return redirect()->back()->with('success', 'You Have Successfully Created kategori.');
        } else {
            return redirect()->back()->with('error', 'You Have Failed Create Kategori.');
        }
    }

    public function update(KategoriWisata $kwst, Request $request)
    {
        $validateDate = $request->validate([
            'kategori_wisata' => 'nullable'
        ]);

        $result = $kwst->update($validateDate);
        if ($result) {
            return redirect(Route('kwst.index'))->with('success', 'Kategori Wisata Updated Successfully.');
        } else {
            return redirect(Route('kwst.index'))->with('error', 'Kategori Wisata Updated Failed.');
        }
    }

    public function destroy(KategoriWisata $kategoriWisata)
    {
        $result = $kategoriWisata->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Kategori Wisata Delete Successfully.');
        } else {
            return redirect()->back()->with('error', 'Kategori Wisata Delete Failed.');
        }
    }
    public function index()
    {
        $datas = KategoriWisata::all();
        $title = 'Kategori Wisata';
        return view('dashboard.kategori-wisata.index', compact('datas', 'title'));
    }
}
