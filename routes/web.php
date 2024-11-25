<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Web;
use App\Http\Controllers\KeySeriesController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\RecapController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return Inertia::render('Dashboard');
        return redirect()->route('keySeries.index');
    })->name('dashboard');
    // CRA
    Route::get('/cra', [Web\CraController::class, 'index'])->name('cra');
    // MASTER DATA
    Route::get('/master-data', function() {
        return Inertia::render('Master/Index');
    })->name('masterData');
    // CRA
    Route::get('/master-data/cra', Web\MasterCraController::class)->name('masterCra');
    Route::get('/master-data/cra/create', [Web\MasterCraController::class, 'create'])->name('masterCra.create');
    Route::post('/master-data/cra/import', [Web\MasterCraController::class, 'import'])->name('masterCra.import');
    Route::post('/master-data/cra', [Web\MasterCraController::class, 'store'])->name('masterCra.store');
    Route::post('/master-data/add-task', [Web\MasterCraController::class, 'addTask'])->name('masterCra.addTask');
    // TASKS
    Route::get('/task', [Web\TaskController::class, 'index'])->name('task');
    // Key Series
    Route::get('/key-series', [KeySeriesController::class, 'index'])->name('keySeries.index');
    Route::get('/key-series/{date}', [KeySeriesController::class, 'detail'])->name('keySeries.detail');
    Route::post('/key-series', [KeySeriesController::class, 'store'])->name('keySeries.store');
    Route::get('/key-series/check', [KeySeriesController::class, 'check'])->name('keySeries.check');
    Route::get('/key/generate', [KeySeriesController::class, 'keyGenerate'])->name('keySeries.generate');
    Route::get('/key/multi-generate/{limit}', [KeySeriesController::class, 'multiGenerate'])->name('keySeries.multiGenerate');
    Route::put('/key-series/{KeySeries:id}', [KeySeriesController::class, 'update'])->name('keySeries.update');
    // Ar Invoice
    Route::get('/ar-invoice', [Web\ArInvoiceController::class, 'index'])->name('arInvoice.index');
    Route::post('/ar-invoice', [Web\ArInvoiceController::class, 'store'])->name('arInvoice.store');
    Route::post('/ar-invoice/multiple', [Web\ArInvoiceController::class, 'multipleStore'])->name('arInvoice.multipleStore');
    Route::post('/ar-series/rollback', [Web\ArSeriesController::class, 'rollback'])->name('arSeries.rollback');
    // ERP SYNC
    Route::get('/sync/ar-invoice', [SyncController::class, 'arInvoice'])->name('sync.arInvoice');
    // AR Series
    Route::get('/ar-series', [Web\ArSeriesController::class, 'index'])->name('arSeries.index');
    Route::post('/ar-series/update', [Web\ArSeriesController::class, 'update'])->name('arSeries.update');
    Route::post('/ar-series/multipleUpdate', [Web\ArSeriesController::class, 'multipleUpdate'])->name('arSeries.multipleUpdate');
    // PAIRING KEY TO SERIES
    Route::post('/pair', [Web\PairController::class, 'store'])->name('pair.store');
    Route::post('/multi-pairing', [Web\PairController::class, 'multiPairing'])->name('pair.multiPairing');
    // DOWNLOAD EXCEL 
    Route::get('/export-excel', [Web\ArInvoiceController::class, 'exportExcel'])->name('export.excel');
    // Recapt
    Route::get('/recap/arseries', [RecapController::class, 'arseries'])->name('recap.arseries');
    // REPORT
    Route::get('/report', [Web\Report\LocalReportController::class, 'index'])->name('report.index');
    Route::get('/report/erp', [Web\Report\SapReportController::class, 'index'])->name('report.erp');
    // SETTINGS
    Route::post('/change-company', [Web\SettingController::class, 'changeCompany'])->name('setting.changeCompany');
});