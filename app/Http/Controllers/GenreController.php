<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function getGenres(){
        //api Movies apiGenres
        Genre::apiGenres();
        $genres = Genre::all();
        return $genres;
    }
}
