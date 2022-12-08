<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
// use App\Models\Movie;
use Illuminate\Support\Facades\DB;
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

//Vistas
Route::get('/', function () {
    $movies = DB::table('movies')->orderBy('id', 'desc')->paginate(5);
    return view('layouts/app',  ['movie' => $movies]);
});

Route::get('/detail/{id}', function ($id) {
    $movie = Movie::find($id);
    return view('layouts/detail', ['movie' => $movie]);
});

//API
Route::get('/movies', [MoviesController::class, 'getMovies']);
// Route::get('/test', [MoviesController::class, 'get']);
