<?php

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;

//Login and Register route Dos not need Authenticaton
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(["auth:sanctum",'users','abilities:check-status,place-orders'])->group(function () 
{
    //Movie Route
    Route::apiResource("movie",MovieController::class);
    Route::get('/movie-search', [MovieController::class,"search"]);
    Route::get('/movie-sort', [MovieController::class,"sort"]);

    //Rating Route
    Route::apiResource("rating",RatingController::class);

  ///logout==========================================================
  Route::post('/logout', [AuthController::class, 'logout']);
});


