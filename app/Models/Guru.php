<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nuptk',
        'email',
        'phone',
        'address',
        'photo',
    ];

    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'jadwal_pelajarans', 'guru_id', 'mata_pelajaran_id');
    }

    /**
     * Get the first MataPelajaran associated with the Guru through JadwalPelajaran.
     */
    public function mataPelajaran()
    {
        return $this->hasOneThrough(
            MataPelajaran::class,
            JadwalPelajaran::class,
            'guru_id',           // Foreign key on JadwalPelajaran table...
            'id',                // Foreign key on MataPelajaran table...
            'id',                // Local key on Guru table...
            'mata_pelajaran_id'  // Local key on JadwalPelajaran table...
        );
    }

    // Accessor to handle singular 'mataPelajaran' access in views
    public function getMataPelajaranAttribute()
    {
        return $this->mataPelajarans->first()->nama_mapel ?? 'Tidak Ada';
    }
}


