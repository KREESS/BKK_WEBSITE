<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->role === 'admin') {
            return view('dashboard.index', [
                'users'             => $user,
                'totalLowongan'     => Lowongan::count(),
                'totalUser'         => User::where('role_id', 1)->count(),
                'totalInformasi'    => Informasi::count(),
            ]);
        }

        $pendaftar = Pendaftar::where('user_id', $user->id)->with('lowongan')->get();

        $totalLamaran = $pendaftar->count();
        $totalLunas = $pendaftar->where('status_pembayaran', 'lunas')->count();
        $totalBelum = $totalLamaran - $totalLunas;

        return view('dashboard.index', [
            'users'             => $user,
            'pendaftar'         => $pendaftar,
            'totalLamaran'      => $totalLamaran,
            'totalLunas'        => $totalLunas,
            'totalBelum'        => $totalBelum,
        ]);
    }
}
