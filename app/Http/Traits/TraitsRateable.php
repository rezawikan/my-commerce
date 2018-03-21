<?php

namespace App\Http\Middleware\Traits;

/**
*
*/
trait TraitsRateable
{
    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function ratings()
    {
        return $this->morphMany('App\Models\Rating', 'rateable');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAverageRating()
    {
        return $this->ratings()->where('user_id', \Auth::id())->avg('rating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userSumRating()
    {
        return $this->ratings()->where('user_id', \Auth::id())->sum('rating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();
        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }
}
