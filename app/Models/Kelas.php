<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'kapasitas',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

