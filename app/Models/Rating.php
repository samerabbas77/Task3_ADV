<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * fillable varaiables
     * @var array
     */
    protected $fillable =
                        [
                            "rating",
                            "review",
                            "movie_id",
                            "user_id"
                        ];



    /**
     * The Relationsheap function for the Rating class eith the Movie class (one To many)
     * get the movie off this rating
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }



    /**
     * The Relationsheap fuction for Rating class with the User class (one To many)
     * get the user who rate the movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
