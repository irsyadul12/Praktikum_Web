<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'jenis',
        'kategori',
        'poin',
        'keterangan',
        'sanksi',
        'tanggal',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the student that owns the Pelanggaran.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user who created the Pelanggaran.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
