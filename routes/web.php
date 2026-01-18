<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use Carbon\Carbon;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\JamPelajaranController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Routes accessible by both 'admin' and 'guru'
    Route::middleware(['role:admin,guru'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('students', StudentController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('pelanggarans', PelanggaranController::class);
        Route::resource('prestasi', PrestasiController::class);
        
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
        Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');

        // Laporan Routes (siswa, kelas, absensi, pelanggaran, prestasi)
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/siswa', [LaporanController::class, 'siswa'])->name('siswa');
            Route::get('/kelas', [LaporanController::class, 'kelas'])->name('kelas');
            Route::get('/absensi', [LaporanController::class, 'absensi'])->name('absensi');
            Route::get('/pelanggaran', [LaporanController::class, 'pelanggaran'])->name('pelanggaran');
            Route::get('/prestasi', [LaporanController::class, 'prestasi'])->name('prestasi');
        });

        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

        // Settings Routes
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

        // Activity Log Route
        Route::get('/activity-log', [ProfileController::class, 'activityLog'])->name('activity_log.index');
    });

    // Routes accessible ONLY by 'admin'
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('mata-pelajaran', MataPelajaranController::class);
        Route::resource('jam-pelajaran', JamPelajaranController::class);
        Route::resource('gurus', GuruController::class);
        Route::resource('jadwal', JadwalPelajaranController::class);

        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('index'); // General laporan index
            Route::get('/guru', [LaporanController::class, 'guru'])->name('guru');
            Route::get('/mata-pelajaran', [LaporanController::class, 'mataPelajaran'])->name('mata-pelajaran');
        });

        // Notification Routes (assuming admin manages notifications)
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
        Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    });
});

Route::get('/api/stats/students-by-class', function () {
    $stats = Student::select('kelas.nama as kelas_name', DB::raw('count(*) as total'))
        ->join('kelas', 'students.kelas_id', '=', 'kelas.id')
        ->groupBy('kelas_name')
        ->pluck('total', 'kelas_name');

    return response()->json([
        'labels' => $stats->keys(),
        'data' => $stats->values(),
    ]);
});

Route::get('/api/stats/monthly-records', function () {
    $months = [];
    $pelanggaranData = [];
    $prestasiData = [];

    for ($i = 5; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $monthName = $date->format('F');
        $months[] = $monthName;

        $pelanggaranData[] = Pelanggaran::whereYear('tanggal', $date->year)
                                        ->whereMonth('tanggal', $date->month)
                                        ->count();
        
        $prestasiData[] = Prestasi::whereYear('tanggal', $date->year)
                                    ->whereMonth('tanggal', $date->month)
                                    ->count();
    }

    return response()->json([
        'labels' => $months,
        'pelanggaran' => $pelanggaranData,
        'prestasi' => $prestasiData,
    ]);
});