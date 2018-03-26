<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $category;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Category $category)
    {
        // Dependencies automatically resolved by service container...
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categoryComposer', $this->category);
    }
}
