<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Hero;
use App\Models\Fasilitas;
use App\Models\Kegiatan;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Http\Controllers\Admin\BookingApprovalController;
use App\Http\Controllers\KomunitasRegisterController;
use App\Http\Controllers\Admin\KomunitasController;
use App\Http\Controllers\HolidayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// PUBLIC ROUTES (Bisa diakses siapa saja)
// ==========================================
Route::get('/', function () {
    $heroes = Hero::latest()->get();
    $fasilitas = Fasilitas::latest()->take(4)->get();
    $kegiatans = Kegiatan::latest()->take(2)->get();
    return view('pages.home', compact('heroes', 'fasilitas', 'kegiatans'));
});

Route::get('/komunitas', function () {
    $komunitas = \App\Models\Komunitas::where('status', 'approved')->latest()->get();
    return view('pages.komunitas', compact('komunitas'));
});

Route::get('/pesan-ruangan', [BookingController::class, 'index']);

Route::post('/booking', [BookingController::class, 'store']);

Route::get('/fasilitas', function () {
    $fasilitas = Fasilitas::latest()->paginate(10);
    return view('pages.fasilitas', compact('fasilitas'));
});

Route::get('/kegiatan', function () {
    $kegiatans = \App\Models\Kegiatan::latest()->paginate(6);
    return view('pages.kegiatan', compact('kegiatans'));
});

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
});

// ==========================================
// PROFILE ROUTES (Semua user yang login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// PANEL ADMIN (Hanya Role Admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Redirect /admin ke dashboard
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Resource Routes
    Route::resource('/admin/fasilitas', App\Http\Controllers\Admin\FasilitasController::class);
    Route::resource('/admin/kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
    
    // Resource Komunitas + Approval Routes
    Route::resource('/admin/komunitas', KomunitasController::class)->names([
        'index' => 'komunitas.index',
        'destroy' => 'komunitas.destroy',
    ]);
    Route::post('/admin/komunitas/{id}/approve', [KomunitasController::class, 'approve'])->name('admin.komunitas.approve');
    Route::post('/admin/komunitas/{id}/reject', [KomunitasController::class, 'reject'])->name('admin.komunitas.reject');

    // Booking Approval
    Route::get('/admin/booking', [BookingApprovalController::class, 'index'])->name('admin.booking.index');
    Route::post('/admin/booking/{id}/approve', [BookingApprovalController::class, 'approve'])->name('admin.booking.approve');
    Route::post('/admin/booking/{id}/reject', [BookingApprovalController::class, 'reject'])->name('admin.booking.reject');
    Route::get('/admin/booking/{id}/edit', [BookingApprovalController::class, 'edit'])->name('admin.booking.edit');
    Route::put('/admin/booking/{id}', [BookingApprovalController::class, 'update'])->name('admin.booking.update');
    Route::delete('/admin/booking/{id}', [BookingApprovalController::class, 'destroy'])->name('admin.booking.destroy');

    // Holiday
    Route::post('/admin/holidays/bulk', [HolidayController::class, 'storeBulk'])->name('holidays.bulk');
    Route::delete('/admin/holidays/{id}', [HolidayController::class, 'destroy'])->name('holidays.destroy');
});


// ==========================================
// PANEL KOMUNITAS (Hanya Role Komunitas)
// ==========================================
Route::middleware(['auth', 'role:komunitas'])->group(function () {
    
    Route::get('/komunitas/dashboard', function () {
        return view('komunitas.dashboard');
    })->name('komunitas.dashboard');

    Route::get('/komunitas/dashboard', function () {
        return view('komunitas.dashboard');
    })->name('komunitas.dashboard');

    // --- TAMBAHKAN RUTE INI BUAT NYIMPEN DESKRIPSI ---
    Route::put('/komunitas/dashboard/update', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        $komunitas = \App\Models\Komunitas::where('user_id', Auth::id())->first();
        if ($komunitas) {
            $komunitas->update(['deskripsi' => $request->deskripsi]);
        }

        return redirect()->back()->with('success', 'Deskripsi komunitas berhasil disimpan!');
    })->name('komunitas.update-deskripsi');

});

// ==========================================
// GUEST ROUTES (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/daftar-komunitas', [KomunitasRegisterController::class, 'create'])->name('komunitas.register');
    Route::post('/daftar-komunitas', [KomunitasRegisterController::class, 'store']);
});

require __DIR__.'/auth.php';