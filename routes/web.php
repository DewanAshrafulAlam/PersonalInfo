<?php
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

    
Route::get('/search', [PostController::class, 'searchData'])->name('search');
Route::get('/download-pdf', [PostController::class, 'downloadPDF'])->name('download.pdf');

    
    Route::get('/', function () {
    return view('login');      // create resources/views/login.blade.php
     })->name('login');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/home', [AuthController::class, 'logout'])->name('logout'); 
       
    
    
    Route::get('/home',function(){
    return view('welcome', ['posts' => Post::paginate(4)]);
    })->name('home');

    
    Route::middleware('auth')->group(function () {

    Route::get('/create', [PostController::class, 'create']);
    Route::post('/store', [PostController::class, 'ourfilestore'])->name('store');
    Route::get('/edit/{id}', [PostController::class, 'editData'])->middleware('auth')->name('edit');
    Route::post('/update/{id}', [PostController::class, 'updateData'])->name('update');
    Route::delete('/delete/{id}', [PostController::class, 'deleteData'])->name('delete');
    Route::get('/search', [PostController::class, 'searchData'])->name('search');
 
    });