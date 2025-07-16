<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'newLowongan' => Lowongan::orderBy('id', 'desc')->take(3)->get(),
            'totalLowongan' => Lowongan::count(),
            'totalPendaftar' => Pendaftar::count(),
            'totalUser' => User::count(),
            'titleHero' => "Sistem informasi BKK"
        ]);
    }
}
