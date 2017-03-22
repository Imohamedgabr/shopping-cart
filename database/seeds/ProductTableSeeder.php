<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // making a new seed but we need to add stuff to the Model itself
    	// the array is defined in the Model file
        $product = new \App\Product([
        	'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
        	'title' => 'Harry Potter',
        	'description' => 'super cool',
        	'price' => 10
        	]);
        $product->save();

     $product = new \App\Product([
        	'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
        	'title' => 'Laravel Book',
        	'description' => 'super cool',
        	'price' => 15
        	]);
        $product->save();

        $product = new \App\Product([
        	'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
        	'title' => 'Jungle Book',
        	'description' => 'super cool',
        	'price' => 20
        	]);
        $product->save();

           
    }
}
