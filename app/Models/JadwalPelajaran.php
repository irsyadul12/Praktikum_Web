<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajarans';

    protected $fillable = [
        'hari',
        'kelas_id',
        'mata_pelajaran_id',
        'guru_id',
        'jam_pelajaran_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jamPelajaran()
    {
        return $this->belongsTo(JamPelajaran::class);
    }
}
