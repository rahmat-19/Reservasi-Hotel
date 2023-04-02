<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ObjekWisata;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $jUser = User::whereNotIn('level', ['admin', 'pelanggan'])->count();
        $jBerita = Berita::count();
        $jWisata = ObjekWisata::count();
        $jReservasi = Reservasi::count();
        return view('dashboard.index', compact('title', 'jUser', 'jBerita', 'jWisata', 'jReservasi'));
    }
}
