<?php

namespace App\Http\Controllers;

use App\Models\KategoriWisata;
use Illuminate\Http\Request;

class KategoriWisataController extends Controller
{
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

    public function update(KategoriWisata $kategoriWisata, Request $request)
    {
        $validateDate = $request->validate([
            'kategori_wisata' => 'required'
        ]);

        $result = $kategoriWisata->update($validateDate);
        if ($result) {
            return redirect(Route('kategori-wisata.index'))->with('success', 'Kategori Wisata Updated Successfully.');
        } else {
            return redirect(Route('kategori-wisata.index'))->with('error', 'Kategori Wisata Updated Failed.');
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
}
