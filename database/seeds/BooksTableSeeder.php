<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        for ($i = 0; $i < 15; $i++) {
            $title = 'Buku Laravel API v'. $i+1;
            $slug = str_replace(' ', '-', strtolower($title));
            $books[$i] = [
                'title' => $title,
                'slug' => $slug,
                'description' => 'Buku REST API Web Service v' . $i+1,
                'author' => 'Yuda Karnaen',
                'publisher' => 'Bumigora',
                'weight' => rand(0.5,1),
                'created_at' => Carbon\Carbon::now(),
            ];
        }
        DB::table('books')->insert($books);
    }
}
