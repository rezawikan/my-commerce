<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['subject','rating','review','user_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user_name','photo'];

    /**
     * Get all of the owning commentable models.
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    /**
   * Get the user's name.
   *
   * @param  string  $value
   * @return string
   */
    public function getUserNameAttribute()
    {
        return User::find($this->user_id)->name;
    }

    /**
   * Get the user's photo.
   *
   * @param  string  $value
   * @return string
   */
    public function getPhotoAttribute()
    {
        return User::find($this->user_id)->photo;
    }
}
