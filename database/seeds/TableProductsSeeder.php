<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class TableProductsSeeder extends Seeder
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

        $running = Category::where('title', 'Berlari')->first();
        $lifestyle = Category::where('title', 'Lifestyle')->first();
        $sepatu1 = Product::create([
      'name'  => 'Nike Air Force',
      'slug' => str_slug('Nike Air Force', '-'),
      'model' => 'Sepatu Pria',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 340000
    ]);

        $sepatu2 = Product::create([
      'name' => 'Nike Air Max',
      'slug' => str_slug('Nike Air Max', '-'),
      'model' => 'Sepatu Wanita',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 420000
    ]);
        $sepatu3 = Product::create([
      'name' => 'Nike Air Zoom',
      'slug' => str_slug('Nike Air Zoom', '-'),
      'model' => 'Sepatu Wanita',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 360000]);
        $running->products()->saveMany([$sepatu1, $sepatu2, $sepatu3]);
        $lifestyle->products()->saveMany([$sepatu1, $sepatu2]);

        $jacket = Category::where('title', 'Jaket')->first();
        $vest = Category::where('title', 'Rompi')->first();
        $jacket1 = Product::create([
      'name' => 'Nike Aeroloft Bomber',
      'slug' => str_slug('Nike Aeroloft Bomber', '-'),
      'model' => 'Jaket Wanita',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 720000
      ]);
        $jacket2 = Product::create([
      'name' => 'Nike Guild 550',
      'slug' => str_slug('Nike Guild 550', '-'),
      'model' => 'Jaket Pria',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 380000
      ]);
        $jacket3 = Product::create([
      'name' => 'Nike SB Steele',
      'slug' => str_slug('Nike SB Steele', '-'),
      'model' => 'Jaket Pria',
      'description' => 'This is new',
      'stock' => rand(1, 20),
      'price' => 1200000
      ]);
        $jacket->products()->saveMany([$jacket1, $jacket3]);
        $vest->products()->saveMany([$jacket2, $jacket3]);
    }
}
