<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Hero;
use App\Models\Fasilitas;
use App\Models\Kegiatan;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Http\Controllers\Admin\BookingApprovalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $heroes = Hero::latest()->get();

    $fasilitas = Fasilitas::latest()->take(4)->get();

    $kegiatans = Kegiatan::latest()->take(2)->get();

    return view('pages.home', compact('heroes', 'fasilitas', 'kegiatans'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/komunitas', function () {
    $komunitas = \App\Models\Komunitas::latest()->get();

    return view('pages.komunitas', compact('komunitas'));
});

Route::get('/pesan-ruangan', function () {
    $bookings = Booking::where('status', 'approved')->get();

    return view('pages.pesan-ruangan', compact('bookings'));
});

Route::post('/booking', [BookingController::class, 'store']);

Route::get('/fasilitas', function () {
    $fasilitas = Fasilitas::latest()->paginate(10); // pagination 10 per page
    return view('pages.fasilitas', compact('fasilitas'));
});

Route::get('/kegiatan', function () {
    $kegiatans = \App\Models\Kegiatan::latest()->paginate(6); // pagination 6 per page
    return view('pages.kegiatan', compact('kegiatans'));
});

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::resource('/admin/fasilitas', App\Http\Controllers\Admin\FasilitasController::class);
    Route::resource('/admin/kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
    Route::resource('/admin/komunitas', App\Http\Controllers\Admin\KomunitasController::class);

    Route::get('/admin/booking', [BookingApprovalController::class, 'index'])->name('admin.booking.index');
    Route::post('/admin/booking/{id}/approve', [BookingApprovalController::class, 'approve'])->name('admin.booking.approve');
    Route::post('/admin/booking/{id}/reject', [BookingApprovalController::class, 'reject'])->name('admin.booking.reject');

    Route::get('/admin/booking/{id}/edit', [BookingApprovalController::class, 'edit'])->name('admin.booking.edit');
    Route::put('/admin/booking/{id}', [BookingApprovalController::class, 'update'])->name('admin.booking.update');
    Route::delete('/admin/booking/{id}', [BookingApprovalController::class, 'destroy'])->name('admin.booking.destroy');
});


require __DIR__.'/auth.php';
