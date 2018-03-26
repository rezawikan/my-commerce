<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\RatingService;

class ApiRatingServiceController extends Controller
{
    /**
     * The cart factory instance.
     *
     * @var \App\Support\CartService
     */
    protected $ratings;

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct(RatingService $ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * Display a listing of the carts.
     *
     * @return \Illuminate\Http\Response
     */
    public function ratingDetails($id)
    {
        return $this->ratings->details($id);
    }
}
