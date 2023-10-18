<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

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


      public function isOwner(){
        return $this-> owner-> id === auth()->id();
        //también es posible así
        // return $this->owner == auth()->user();
      }


      protected static function boot() {
        parent::boot();

        static::deleting(function($post) {
          if( ! App()->runningInConsole()&& $post->replies()->count() ) {
              $post->replies()->delete();
    }
});

}
}
