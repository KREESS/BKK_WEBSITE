<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Lowongan extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    // Optional: bisa tambahkan accessor buat format tampilan uang
    public function getPembayaranFormatAttribute()
    {
        return 'Rp ' . number_format($this->pembayaran, 0, ',', '.');
    }
}
