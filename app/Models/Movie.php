<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Movie extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'genres',
        'language',
        'original_title',
        'summary'
    ];

    private function apiMovies(){ //api externa 
        $movies = Http::get("https://api.themoviedb.org/3/movie/latest?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9");        
        return $movies->json($key = null);
    }


    protected function uploadMovies(){

        $api = $this->apiMovies();
        $movie = Movie::find($api['id']);

        if(!$movie) {
            
            $newMovie = new Movie();
    
            $newMovie->id = $api['id'];
            $newMovie->name = $api['title'];
            $newMovie->language = $api['original_language'];
            $newMovie->original_title = $api['original_title'];
            $newMovie->summary = $api['overview'];
            
            $newMovie->save();
            
            //Asignacion de genres y movies en tabla pivot
            for($i = 0; $i < count($api['genres']); $i++) {
                $genre = Genre::find($api['genres'][$i]['id']);
                if ($genre) {
                    $genre->movies()->attach($api['id']);
                }
            }
        } 

    }
    
    //show number of movies by descendant id 
    protected function showNumberOfMoviesByDescendantId($quantity){
        return DB::table('movies')->orderBy('id', 'desc')->paginate($quantity);
        // return DB::table('movies')->load('genres');
    }

    //relacion muchos a muchos
    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
}
