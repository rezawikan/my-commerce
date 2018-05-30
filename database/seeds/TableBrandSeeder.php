<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class TableBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create(['title' => 'Adidas', 'slug' => str_slug('Adidas', '-')]);
        Brand::create(['title' => 'Oakley', 'slug' => str_slug('Oakley', '-')]);
        Brand::create(['title' => 'Bilabong', 'slug' => str_slug('Bilabong', '-')]);
        Brand::create(['title' => 'Nine West', 'slug' => str_slug('Nine West', '-')]);
        Brand::create(['title' => 'Puma', 'slug' => str_slug('Puma', '-')]);
        Brand::create(['title' => 'New Balance', 'slug' => str_slug('New Balance', '-')]);
        Brand::create(['title' => 'Tony Hawk', 'slug' => str_slug('Tony Hawk', '-')]);
        Brand::create(['title' => 'Surfer Girl', 'slug' => str_slug('Surfer Girl', '-')]);
    }
}
