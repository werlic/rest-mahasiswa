<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = ['nim', 'nama', 'jk', 'jurusan_id', 'alamat', 'email'];

    public function user()
    {
        return $this->hasOne(UserMahasiswa::class, 'nim', 'nim');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
