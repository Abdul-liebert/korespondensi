<?php

use App\Http\Controllers\generatepdf;
use App\Http\Controllers\GeneratePdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\NotulensiController;
use App\Http\Controllers\NomorSuratController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\suratKeluarController;
use App\Http\Controllers\SuratPengajuanController;
use App\Http\Controllers\SuratPeringatanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::controller(GuruController::class)->group(function() {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    Route::delete('/guru/delete/{id}', 'destroy')->name('guru.destory');
});

Route::get('/korespondensi', [indexController::class, 'index'])->name('inbox.index');



Route::get('/pdf/{model}', [GeneratePdfController::class, 'generatepdf'])->name('pdf');

Route::controller(SuratMasukController::class)->group(function() {
    // Route::get('/inbox', 'index')->name('inbox.index');
    Route::post('/korespondensi', 'store')->name('inbox.store');
    Route::get('/korespondensi/{id}/edit', 'edit')->name('inbox.edit');
    Route::get('/korespondensi/{id}/download', 'download')->name('inbox.download');
    Route::put('/korespondensi/{id}', 'update')->name('inbox.update');
    Route::get('korespondensi/pdf', 'generatepdf')->name('inbox.pdf');
    Route::delete('/korespondensi/delete/{id}', 'destroy')->name('inbox.destroy');
});

Route::controller(suratKeluarController::class)->group(function() {
    Route::post('/outbox', 'store')->name('outbox.store');
    Route::get('/outbox/{id}/edit', 'edit')->name('outbox.edit');
    Route::get('/outbox/{id}/download', 'download')->name('outbox.download');
    Route::put('/outbox/{id}', 'update')->name('outbox.update');
    Route::delete('/outbox/delete/{id}', 'destroy')->name('outbox.destroy');
});

Route::controller(SuratPeringatanController::class)->group(function() { 
    Route::post('/sp', 'store')->name('sp.store');
    Route::get('/sp/{id}/edit', 'edit')->name('sp.edit');
    route::get('/sp/{id}/download', 'download')->name('sp.download');
    Route::put('/sp/{id}', 'update')->name('sp.update');
    Route::delete('/sp/delete/{id}', 'destroy')->name('sp.destroy');
});

Route::controller(NomorSuratController::class)->group(function(){
    Route::post('/no_surat', 'store')->name('no_surat.store');
    Route::get('/no_surat/{id}/edit', 'edit')->name('no_surat.edit');
    Route::put('/no_surat/{id}', 'update')->name('no_surat.update');
    Route::delete('/no_surat/delete/{id}', 'destroy')->name('no_surat.destroy');
});

Route::controller(NotulensiController::class)->group(function(){
    Route::post('/notulensi', 'store')->name('notulensi.store');
    Route::get('/notulensi/{id}/edit', 'edit')->name('notulensi.edit');
    Route::get('/notulensi/{id}/downloadSurat', 'downloadSurat')->name('notulensi.download');
    Route::get('/notulensi/{id}/downloadDokumentasi', 'downloadDokumentasi')->name('notulensi.download_dokumentasi');
    Route::put('/notulensi/{id}', 'update')->name('notulensi.update');
    Route::delete('/notulensi/delete/{id}', 'destroy')->name('notulensi.destroy');
});

Route::controller(SuratPengajuanController::class)->group(function(){
    Route::post('/pengajuan', 'store')->name('pengajuan.store');
    Route::get('/pengajuan/{id}/edit', 'edit')->name('pengajuan.edit');
    Route::get('/pengajuan/{id}/download', 'download')->name('pengajuan.download');
    Route::put('/pengajuan/{id}', 'update')->name('pengajuan.update');
    Route::delete('/pengajuan/delete/{id}', 'destroy')->name('pengajuan.destroy');
});

require __DIR__.'/auth.php';

