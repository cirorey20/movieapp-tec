<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    protected function apiGenres(){ //api externa
        $gns = Http::get("https://api.themoviedb.org/3/genre/movie/list?api_key=620e0ffa7a40a7dc31d8a2be0d18c5b9");
        $g = $gns['genres'];

        $newGenre = new Genre();

        for($i = 0; $i < count($g); $i++) {
            $newGenre->updateOrCreate([
                'id' => $g[$i]['id'],
                'name' => $g[$i]['name']

            ]);
        }
    }

    //relacion muchos a muchos
    public function movies(){
        return $this->belongsToMany(Movie::class);
    }
}
