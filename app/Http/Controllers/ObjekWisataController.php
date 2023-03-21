<?php

namespace App\Http\Controllers;

use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class ObjekWisataController extends Controller
{
    public function index()
    {
        $datas = ObjekWisata::all();
        // return view('objek_wisata.index', $datas);
    }

    public function edit(ObjekWisata $objWisata)
    {
        return view('objek_wisata.edit', $objWisata);
    }

    public function update()
    {
    }

    public function create()
    {
    }
    public function store()
    {
    }
}
