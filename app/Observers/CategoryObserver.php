<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Listen to the Category creating event.
     *
     * @param  Category  $categories
     * @return void
     */
    public function creating(Category $categories)
    {
        $categories->slug = str_slug($categories->title);
    }

    /**
     * Listen to the Category deleting event.
     *
     * @param  Category  $categories
     * @return void
     */
    public function deleting(Category $categories)
    {
        $categories->products()->detach();
        foreach ($categories->childs as $child) {
            $child->parent_id = null;
            $child->save();
        }
    }
}
