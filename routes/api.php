<?php

use App\Http\Controllers\MovieController;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("movie",MovieController::class);

Route::get('/movie-search', [MovieController::class,"search"]);
Route::get('/movie-sort', [MovieController::class,"sort"]);
