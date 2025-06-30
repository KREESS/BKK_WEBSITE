<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinatSiswa extends Model
{
    protected $fillable = [
        'user_id',      // ✅ ditambahkan
        'nama',
        'nisn',
        'kelas',
        'jurusan',
        'minat',
        'alasan',
        'kontak'
    ];

    protected $casts = [
        'minat' => 'array', // untuk menyimpan data checkbox sebagai array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
