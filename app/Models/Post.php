<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts'; //Es[pecificamos la tabla, normalmente el plural del modelo, Post en este caso

    protected $fillable = [ //--> Especificamos campo que rellenamos
        'user_id',
        'forum_id',
        'title',
        'description'
    ];
    
    public function forum (): BelongsTo {
      return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function owner (): BelongsTo {
      return $this->belongsTo(User::class, 'user_id');
    }
    public function replies(): HasMany{
      return $this->hasMany(Reply::class);
      }      

      protected static function boot() {
        parent::boot();

        
        static::creating(function($post) {
          if( ! App::runningInConsole() ) {
            $post->user_id = auth()->id();
          }
        });
    }
}
