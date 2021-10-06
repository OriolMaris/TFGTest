<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User
Route::post('/register', [UserController::class, 'register']); 
Route::post('/login', [UserController::class, 'login']); 

// Animals

Route::get('/users', [UserController::class, 'index']); 
Route::get('/animals/search/{name}', [AnimalController::class, 'search']); 

//email verification
//Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); 
//Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');  
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/userVerified/{id}', [UserController::class, 'userVerified']); 
//


// Auth pages where u need to be registered
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Animals
    //Route::post('/animals', [AnimalController::class, 'store']); 
    
   
    // User
    Route::delete('/logout', [UserController::class, 'logout']); 

});

Route::get('/animals', [AnimalController::class, 'index']); 
Route::post('/animals/advSearch', [AnimalController::class, 'advSearch']); 

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{id}', [UserController::class, 'getUser']); 

Route::post('/animals', [AnimalController::class, 'store']); 
Route::put('/animals/{id}', [AnimalController::class, 'update']); 
Route::put('/user/{id}', [UserController::class, 'update']); 
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']); 

Route::post('/upload', [PhotoController::class, 'upload']); 
Route::get('/upload', [PhotoController::class, 'index']);
Route::get('/upload/{photo}', [PhotoController::class, 'show']);
Route::delete('/upload/{id}', [PhotoController::class, 'destroy']);
Route::get('/upload/animal/{id}', [PhotoController::class, 'search']);

Route::get('/animals/cats', [AnimalController::class, 'cats']); 
Route::get('/animals/dogs', [AnimalController::class, 'dogs']); 

Route::get('/animals/{user_id}/owner', [AnimalController::class, 'owner']); 


Route::get('/users/{user_id}/fav', [FavouritesController::class, 'get_favourites']);
Route::post('/users/{user_id}/fav/{animal_id}', [FavouritesController::class, 'store']); 
Route::delete('/users/{user_id}/fav/{animal_id}', [FavouritesController::class, 'delete']); 
Route::get('/users/{user_id}/fav/{animal_id}', [FavouritesController::class, 'isFavourite']); 



///new test 
Route::post('/upload2', [PhotoController::class, 'upload2']); 
Route::get('/upload2/{photo}', [PhotoController::class, 'download2']); 
