<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Reply extends Model
{
    use HasFactory;
    protected $table = 'replys';//Es[pecificamos la tabla, normalmente el plural del modelo, Post en este caso

    protected $fillable = [ //--> Especificamos campo que rellenamos
        'post_id',
        'user_id',
        'reply',
        'attachment',
    ];

     // Para poder acceder al Foro desde esta tabla crearemos un atributo extra
     protected  $appends = ['forum'];

     public function post(){
         return $this->belongsTo(Post::class, 'post_id');
     }
 
     public function autor(){
         return $this->belongsTo(User::class, 'user_id');
     }
 
     protected static function boot() {
        parent::boot();

        static::creating(function($reply) {
            if( ! App::runningInConsole() ) {
            $reply->user_id = auth()->id();
            }
        });
    }
     // Y aquí definimos el Atributo extra
     // Para hacer eso, la función debe comenzar por "get"
     // y finalizar por "Attribute" (y lo de en medio CamelCase)
     public function getForumAttribute() {
         return $this->post->forum;
     }
}
