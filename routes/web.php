<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
Route::get('/',[UserController::class,'showDataInHome'] )->name('home');
Route::get('/fullpost/{id}',[UserController::class,'showFullPost'])->name('fullpost');

Route::get('/dashboard', [UserController::class,'home'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin/dashboard', [UserController::class,'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');
// Route::get('/admin/dashboard/post', [UserController::class,'post'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard', [UserController::class,'index'])->name('admin.dashboard');
    Route::get('/dashboard/addpost', [AdminController::class,'addpost'])->name('admin.addpost'); // 顯示表單
    Route::get('/dashboard/allpost', [AdminController::class,'allpost'])->name('admin.allpost'); // 處理表單
    Route::get('/dashboard/allpost/{id}', [AdminController::class,'updatePost'])->name('admin.update'); 
    Route::post('/dashboard/allpost/{id}', [AdminController::class,'postupdate'])->name('admin.postupdate');
    Route::post('/dashboard/deletepost/{id}', [AdminController::class,'deletePost'])->name('admin.deletepost');
    Route::post('/dashboard/postdelete/{id}', [AdminController::class,'postDelete'])->name('admin.postdelete');
    Route::post('/dashboard/addpost', [AdminController::class, 'createPost'])->name('admin.createpost');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
