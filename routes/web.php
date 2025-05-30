<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComplaintController;

Route::get('/', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
Route::get('/admin/dashboard', [ComplaintController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/search', [ComplaintController::class, 'search'])->name('admin.search'); ;

Route::post('/admin/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])->name('admin.complaints.updateStatus');

// Search complaint by ID
Route::post('/track-complaint', [ComplaintController::class, 'searchOnCreate'])->name('complaints.track');

Route::get('/complaint-status', [ComplaintController::class, 'searchForm'])->name('complaints.statusForm');
Route::post('/complaint-status', [ComplaintController::class, 'searchResult']) ->name('complaints.statusResult');
