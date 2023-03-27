<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function create(Request $request)
    {
        $validationData = $request->validate([
            'nama_penginapan' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $validationData['foto'] = $image->hashName();
        }

        $result = Penginapan::create($validationData);
        if ($result) {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->storeAs('public/penginapan', $image->hashName());
            }
            return redirect(Route('penginapan.index'))->with('success', 'You Have Successfully Created an Account.');
        } else {
            return redirect(Route('penginapan.index'))->with('error', 'You Have Failed Create an Account.');
        }
    }

    public function delete(Penginapan $penginapan)
    {
        $result  =  $penginapan->delete();
        if ($result) {
            if ($penginapan->foto) {
                Storage::delete('public/penginapan/' . $penginapan->foto);
            }
            return redirect()->back()->with('success', 'Berita Delete Successfully.');
        } else {
            return redirect()->back()->with('error', 'Berita Delete Failed.');
        }
    }
}
