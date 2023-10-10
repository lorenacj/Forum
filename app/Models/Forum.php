<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Forum extends Model
{
    use HasFactory;

    protected $table = 'forums'; //Es[pecificamos la tabla, normalmente el plural del modelo, Forum en este caso

    protected $fillable = [ //--> Especificamos campo que rellenamos
        'name',
        'description'
    ]; 

    protected $hidden = [ // Especificamos campos ocultos 
        'password',
    ];

    public function posts (): HasMany {
        return $this->hasMany(Post::class); //or cada post ira buscando por cada id de forum todos los posts en ese foro
        }

   public function replies(): HasManyThrough{
        return $this->hasManyThrough(Reply::class, Post::class);   
    }
}
