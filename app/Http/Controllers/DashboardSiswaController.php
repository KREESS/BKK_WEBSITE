<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MinatSiswa;
use Illuminate\Support\Facades\Auth;


class DashboardSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.dashboard'); // Pastikan view ini tersedia
    }

    public function minat()
    {
        $user = Auth::user();

        $existing = MinatSiswa::where('user_id', $user->id)->first();

        return view('siswa.minat_siswa', [
            'data' => $existing
        ]);
    }


    public function store(Request $request)
    {
        // Cegah duplikat dari user yang sama
        if (MinatSiswa::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Kamu sudah mengisi formulir sebelumnya.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nisn' => 'nullable|string|max:100',
            'kelas' => 'required|string|max:10',
            'jurusan' => 'required|string',
            'jurusan_lain' => 'nullable|required_if:jurusan,Lainnya|string|max:100',
            'minat' => 'required|string',
            'alasan' => 'required|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        if ($validated['jurusan'] === 'Lainnya' && $request->filled('jurusan_lain')) {
            $validated['jurusan'] = $request->jurusan_lain;
        }

        $validated['user_id'] = Auth::id(); // tambahkan user_id

        MinatSiswa::create($validated);

        return redirect()->back()->with('success', 'Formulir berhasil dikirim!');
    }

    public function edit()
    {
        $user = Auth::user();
        $data = MinatSiswa::where('user_id', $user->id)->first();

        if (!$data) {
            return redirect()->route('minat-siswa')->with('error', 'Data tidak ditemukan.');
        }

        return view('siswa.edit_minat_siswa', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nisn' => 'nullable|string|max:100',
            'kelas' => 'required|string|max:10',
            'jurusan' => 'required|string',
            'jurusan_lain' => 'nullable|required_if:jurusan,Lainnya|string|max:100',
            'minat' => 'required|string',
            'alasan' => 'required|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $data = MinatSiswa::where('user_id', $user->id)->first();

        if (!$data) {
            return redirect()->route('minat-siswa')->with('error', 'Data tidak ditemukan.');
        }

        if ($validated['jurusan'] === 'Lainnya' && $request->filled('jurusan_lain')) {
            $validated['jurusan'] = $request->jurusan_lain;
        }

        $data->update($validated);

        return redirect()->route('minat.siswa')->with('success', 'Data minat berhasil diperbarui!');
    }
}
