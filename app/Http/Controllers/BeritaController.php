<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function create(Request $request)
    {
        $validateDate = $request->validate([
            'kategori_berita_id' => 'required',
            'judul' => 'required',
            'berita' => 'required',
            'tgl_post' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $validateDate['foto'] = $image->hashName();
        }

        $result = Berita::create($validateDate);
        if ($result) {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->storeAs('public/berita', $image->hashName());
            }
            return redirect(Route('berita.index'))->with('success', 'You Have Successfully Created an News.');
        } else {
            return redirect(Route('berita.index'))->with('success', 'You Have Failed Create an News.');
        }
    }

    public function update(Berita $berita, Request $request)
    {
        $validateData = $request->validate([
            'kategori_berita_id' => 'required',
            'judul' => 'required',
            'berita' => 'required',
            'tgl_post' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('image');
            $validateData['foto'] = $image->hashName();
        }

        $result = $berita->update($validateData);
        if ($result) {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                Storage::delete('public/berita/' . $berita->foto);
                $image->storeAs('public/berita', $image->hashName());
            }
            return redirect(Route('berita.index'))->with('success', 'You Have Successfully Updated an News.');
        } else {
            return redirect(Route('berita.index'))->with('success', 'You Have Failed Updated an News.');
        }
    }

    public function delete(Berita $berita)
    {
        $result = $berita->delete();
        if ($result) {
            if ($berita->foto) {
                Storage::delete('public/berita/' . $berita->foto);
            }

            return redirect()->back()->with('success', 'Berita Delete Successfully.');
        } else {

            return redirect()->back()->with('error', 'Berita Delete Failed.');
        }
    }
}
