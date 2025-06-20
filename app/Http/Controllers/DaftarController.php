<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Storage;

class DaftarController extends Controller
{
    // Menampilkan form lamaran berdasarkan slug lowongan
    public function create($slug)
    {
        $lowongan = Lowongan::where('slug', $slug)->firstOrFail();
        return view('daftar.form', compact('lowongan'));
    }

    // Menyimpan data lamaran kerja
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nohp' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'lowongan_id' => 'required|exists:lowongans,id',
        ]);

        // Simpan file CV ke storage/public/cv_pelamar
        $cvPath = $request->file('cv')->store('cv_pelamar', 'public');

        // Simpan ke database kalau kamu sudah punya model Lamaran
        // Di sini saya contohkan hanya menyimpan ke log
        Log::info('Lamaran baru diterima:', [
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'cv' => $cvPath,
            'lowongan_id' => $request->lowongan_id,
        ]);

        return redirect('/')->with('success', 'Lamaran berhasil dikirim.');
    }
}
