<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Informasi;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika admin
        if ($user->role->role === 'admin') {
            return view('dashboard.index', [
                'users'             => $user,
                'totalLowongan'     => Lowongan::count(),
                'totalUser'         => User::where('role_id', 1)->count(),
                'totalInformasi'    => Informasi::count(),
            ]);
        }

        // Jika user biasa
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

    /**
     * Untuk pencarian live yang me-render ulang seluruh halaman (hero + lowongan)
     */
    public function search(Request $request)
    {
        $query = $request->query('query');

        $lowongans = Lowongan::where('judul', 'like', '%' . $query . '%')->get();

        return view('partials.halaman_lowongan', [
            'titleHero' => 'Hasil Pencarian: ' . $query,
            'newLowongan' => $lowongans
        ]);
    }
}
