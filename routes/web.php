<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'user', 'verified',])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin/category')->group(function(){
    Route::get("/", [AdminController::class, "showDataCategory"]);
    Route::post("/store", [AdminController::class, "storeDataCategory"]);
    Route::post("/update/{id}", [AdminController::class, "updateDataCategory"]);
    Route::get("/destroy/{id}", [AdminController::class, "destroyDataCategory"]);
});

Route::prefix('/admin/supplier')->group(function(){
    Route::get("/", [AdminController::class, "showDataSupplier"]);
    Route::post("/store", [AdminController::class, "storeDataSupplier"]);
    Route::post("/update/{id}", [AdminController::class, "updateDataSupplier"]);
    Route::get("/destroy/{id}", [AdminController::class, "destroyDataSupplier"]);
});

Route::prefix('/admin/user')->group(function(){
    Route::get("/", [AdminController::class, "showDataUser"]);
    Route::post("/store", [AdminController::class, "storeDataUser"]);
    Route::get("/destroy/{id}", [AdminController::class, "destroyDataUser"]);
});

Route::prefix('/admin/item')->group(function(){
    Route::get("/", [AdminController::class, "showDataItem"]);
    Route::post("/store", [AdminController::class, "storeDataItem"]);
    Route::post("/update/{id}", [AdminController::class, "updateDataItem"]);
    Route::get("/destroy/{id}", [AdminController::class, "destroyDataItem"]);
});

Route::get('/dashboard/barang', [UserController::class, "dataBarang" ]);
Route::get('/dashboard/pengajuan', [UserController::class, "dataRequest" ]);
Route::post('/dashboard/store', [UserController::class, "storeRequest" ]);

Route::get('/atasan/dashboard', [AtasanController::class, 'index'])->middleware(['auth', 'atasan']);
Route::get('/atasan/pengajuan', [AtasanController::class, "dataRequest" ]);
Route::post('/atasan/approve/{id}', [AtasanController::class, "AccRequest"]);
Route::post('/atasan/reject/{id}', [AtasanController::class, "RejectRequest"]);

Route::get('/generatepdf', [pdfController::class, 'generatePdf']);


require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
// Route::get("/admin/category", [AdminController::class, "showDataCategory"]);
