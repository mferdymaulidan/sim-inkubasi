<?php

use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\MutasiLaptopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuratController;
use App\Models\Siswa;
use App\Models\Kelas;

Route::resource('/siswa', SiswaController::class)->middleware(['role:admin']);
Route::resource('/kelas', KelasController::class)->middleware(['role:admin']);
Route::resource('/user', UserController::class)->middleware(['role:admin']);
Route::resource('/roles', RoleController::class)->middleware(['role:admin']);
Route::resource('/pelanggaran', PelanggaranController::class)->middleware(['role:admin']);
Route::resource('/dailyr', DailyReportController::class)->middleware('auth');
Route::resource('/galeri', GaleriController::class)->middleware(['role:admin']);
Route::resource('/laptop', LaptopController::class)->middleware(['role:admin']);
Route::resource('/mutlaptop', MutasiLaptopController::class)->middleware(['role:admin']);
Route::get('/suratpelanggaran/{id_pelanggaran}', [SuratController::class, 'generatePdf'])->name('surat.pelanggaran')->middleware(['role:admin']);

Route::get('/dailyreport/file/{filename}', [DailyReportController::class, 'showPdf'])
    ->name('dailyreport.file');

Route::get('/', function () {
        $jumlahsiswa = Siswa::count();
        return view('welcome',compact('jumlahsiswa'));
});

Route::get('/dashboard', function () {
    $jumlahsiswa = Siswa::count();
    $jumlahkelas = Kelas::count();
    return view('dashboard', compact('jumlahsiswa', 'jumlahkelas'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-sdk', function () {
    $s3 = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-1',
        'endpoint' => 'https://objectstorage.simsmk.sch.id',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key' => config('filesystems.disks.s3.key'),
            'secret' => config('filesystems.disks.s3.secret'),
        ],
        'http' => [
            'verify' => false, // <-- ini yang penting untuk lewati SSL error
        ],
    ]);

    try {
        $s3->putObject([
            'Bucket' => 'inkubasi',
            'Key' => 'test-sdk.txt',
            'Body' => 'Hello from SDK',
        ]);
        return 'Upload via SDK berhasil!';
    } catch (\Exception $e) {
        return 'Upload SDK gagal: ' . $e->getMessage();
    }
});

Route::get('/env-check', function () {
    return [
        'from_env' => env('AWS_BUCKET'),
        'from_config' => config('filesystems.disks.s3.bucket'),
    ];
});

require __DIR__.'/auth.php';
