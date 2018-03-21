<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['rating','comment','user_id'];

    /**
     * Get all of the owning commentable models.
     */
    public function rateable()
    {
        return $this->morphTo();
    }
}
