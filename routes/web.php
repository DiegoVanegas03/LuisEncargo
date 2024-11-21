<?php

use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EntregableController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Tarea;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(RoleMiddleware::class . ':profesor')->group(function () {
    Route::post('/tarea', [TareaController::class, 'store'])->name('tarea.register');
    Route::get('/grupo/{grupo_id}/tarea', [TareaController::class, 'form'])->name('tarea.form');
    Route::get('/tarea/{id}/entrega/{entregableId}', [TareaController::class, 'index'])->name('tarea.entrega');
    Route::patch('/entregable', [EntregableController::class, 'update'])->name('entregable.update');
    Route::patch('/tarea', [TareaController::class, 'update'])->name('tarea.update');
    Route::delete('/tarea', [TareaController::class, 'destroy'])->name('tarea.destroy');
    Route::get('/reporte/{id}', [ReporteController::class, 'index'])->name('reporte.index');
});

Route::get('/invoice/download', [ReporteController::class, 'download'])->name('invoice.download');


Route::middleware('auth')->group(function () {
    Route::get('/grupo/{grupo_id}', [DashBoardController::class, 'index'])->name('dashboard.grupo');
    Route::get('/tarea/{id}', [TareaController::class, 'index'])->name('tarea.index');

    Route::get('/grupo/{grupo_id}/edit/{tarea_id}', [TareaController::class, 'edit'])->name('grupo.tarea.edit');
    Route::post('/entregable', [EntregableController::class, 'store'])->name('entregable.register');
    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
