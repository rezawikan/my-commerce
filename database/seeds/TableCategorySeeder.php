<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class TableCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sepatu = Category::create(['title' => 'Sepatu', 'slug' => str_slug('Sepatu', '-')]);
        $sepatu->childs()->saveMany([
          new Category(['title' => 'Lifestyle', 'slug' => str_slug('Lifestyle', '-')]),
          new Category(['title' => 'Berlari', 'slug' => str_slug('Berlari', '-')]),
          new Category(['title' => 'Basket', 'slug' => str_slug('Basket', '-')]),
          new Category(['title' => 'Sepakbola', 'slug' => str_slug('Sepakbola', '-')])
        ]);

        $pakaian = Category::create(['title' => 'Pakaian', 'slug' => str_slug('Pakaian', '-')]);
        $pakaian->childs()->saveMany([
          new Category(['title' => 'Jaket', 'slug' => str_slug('Jaket', '-')]),
          new Category(['title' => 'Hoodie', 'slug' => str_slug('Hoodie', '-')]),
          new Category(['title' => 'Rompi', 'slug' => str_slug('Rompi', '-')]),
        ]);
    }
}
