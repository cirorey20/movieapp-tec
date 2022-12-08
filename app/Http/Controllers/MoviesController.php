<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

//use App\Producto;

class MoviesController extends Controller
{

    /**
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    //devolver todos los productos
    public function __construct(){
        
    }
    public function getMovies(){
        //api Movies
        // $url = "https://api.themoviedb.org/3/movie/550?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9";
        $url = "https://api.themoviedb.org/3/movie/latest?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9";
        $json = file_get_contents($url);
        $datos = json_decode($json, true);


        $movie = DB::table('movies')->where('name', $datos['title'])->first();
        if($movie){
            //"Esta pelicula ya existe"
            
            return redirect('/');
        } else {
            //No existe por lo tanto se debe crear

            $newMovie = new Movie();
    
            $newMovie->name = $datos['title'];
            // $newMovie->genres = json_encode([$datos['genres']]);
            $map = collect($datos['genres']);
            $arrGenres = $map->map(function ($item, $key) {
                return $item['name'];
            });
            $newMovie->genres = $arrGenres;

            $newMovie->language = $datos['original_language'];
            $newMovie->original_title = $datos['original_title'];
            $newMovie->summary = $datos['overview'];
    
            $newMovie->save();
    
            // $movies = DB::table('movies')->get();
            // return $movies;
            return redirect('/');
        }

    }        

    public function get(){

        $url = "https://api.themoviedb.org/3/movie/550?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9";
        //$url = "https://api.themoviedb.org/3/movie/latest?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9";
        $json = file_get_contents($url);
        $datos = json_decode($json, true);

        $api = collect($datos['genres']);
        $arr = $api->map(function ($item, $key) {
            return $item['name'];
        });
        $name = $arr;
        
        return $datos;
    }
    
}
