<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',['posts'=>Post::paginate(4)]);
})->name('home');


Route::get('/create', [PostController::class, 'create']);
Route::post('/store', [PostController::class, 'ourfilestore'])->name('store');
Route::get('/edit/{id}', [PostController::class, 'editData'])->name('edit');
Route::post('/update/{id}', [PostController::class, 'updateData'])->name('update');
Route::delete('/delete/{id}', [PostController::class, 'deleteData'])->name('delete');
Route::get('/search', [PostController::class, 'searchData'])->name('search');