<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;

//use App\Producto;

class MoviesController extends Controller
{

    //Service
    public function getMovies(){
        //api Movies
        Movie::uploadMovies();
        $movies = Movie::all();
        return $movies;
    }


    //VISTAS
    public function index(){
        Movie::uploadMovies();
        $movies = Movie::showNumberOfMoviesByDescendantId(5);
        return view('layouts/app',  ['movie' => $movies]);

    }
    public function movie($id){
        $movie = Movie::find($id);
        return view('layouts/detail', ['movie' => $movie]);
    }
    
}
