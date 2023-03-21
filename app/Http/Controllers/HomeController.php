<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $beritas = Berita::all();
        $objWisata = ObjekWisata::paginate(10);

        return view('home.index', compact($title, $beritas, $objWisata));
    }
}
