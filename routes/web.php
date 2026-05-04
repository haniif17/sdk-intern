<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Hero;
use App\Models\Fasilitas;

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

    return view('pages.home', compact('heroes', 'fasilitas'));
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
    return view('pages.komunitas');
});

Route::get('/pesan-ruangan', function () {
    return view('pages.pesan-ruangan');
});

Route::get('/fasilitas', function () {
    $fasilitas = Fasilitas::latest()->paginate(10); // pagination 10 per page
    return view('pages.fasilitas', compact('fasilitas'));
});

Route::get('/kegiatan', function () {
    return view('pages.kegiatan');
});

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::resource('/admin/fasilitas', App\Http\Controllers\Admin\FasilitasController::class);
});


require __DIR__.'/auth.php';
