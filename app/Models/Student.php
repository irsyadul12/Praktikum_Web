<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggaran;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'kelas_id',
        'photo',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }
}
