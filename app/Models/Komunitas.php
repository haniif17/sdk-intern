<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_komunitas',
        'username',
        'email',
        'nama_ketua',
        'deskripsi',
        'jumlah_anggota',
        'logo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}