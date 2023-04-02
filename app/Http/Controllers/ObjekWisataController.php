<?php

namespace App\Http\Controllers;

use App\Models\KategoriWisata;
use App\Models\ObjekWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObjekWisataController extends Controller
{

    public function index()
    {
        $datas = ObjekWisata::all();
        $title = 'Objek Wisata';
        $kategoriWst = KategoriWisata::all();
        return view('dashboard.objek-wisata.index', compact('datas', 'title', 'kategoriWst'));
    }

    public function edit(ObjekWisata $objwst)
    {
        $data = $objwst;
        $title = 'Edit';
        $kategoriWst = KategoriWisata::all();
        return view('dashboard.objek-wisata.update', compact('data', 'title', 'kategoriWst'));
    }
    public function create(Request $request)
    {
        $validateDate = $request->validate([
            'kategori_wisata_id' => 'required',
            'nama_wisata' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $validateDate['foto'] = 'objekwisata/' . $image->hashName();
        }

        $result = ObjekWisata::create($validateDate);
        if ($result) {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->storeAs('public/objekwisata', $image->hashName());
            }
            return redirect(Route('objwst.index'))->with('success', 'You Have Successfully Created an News.');
        } else {
            return redirect(Route('objwst.index'))->with('success', 'You Have Failed Create an News.');
        }
    }

    public function update(ObjekWisata $objwst, Request $request)
    {
        $validateData = $request->validate([
            'kategori_wisata_id' => 'required',
            'nama_wisata' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $validateData['foto'] = 'objekwisata/' . $image->hashName();
            Storage::delete('public/' . $objwst->foto);
        }

        $result = $objwst->update($validateData);
        if ($result) {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->storeAs('public/objekwisata', $image->hashName());
            }
            return redirect(Route('objwst.index'))->with('success', 'You Have Successfully Updated an News.');
        } else {
            return redirect(Route('objwst.index'))->with('success', 'You Have Failed Updated an News.');
        }
    }

    public function destroy(ObjekWisata $objwst)
    {
        $result = $objwst->delete();
        if ($result) {
            if ($objwst->foto) {
                Storage::delete('public/' . $objwst->foto);
            }

            return redirect()->back()->with('success', 'Berita Delete Successfully.');
        } else {

            return redirect()->back()->with('error', 'Berita Delete Failed.');
        }
    }
}
