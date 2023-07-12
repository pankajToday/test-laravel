<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \DB::table('categories')->delete();

        $data =[
            [ 'name' => 'Sports' ],
            [ 'name' => 'Electric' ],
            [ 'name' => 'News' ],
            [ 'name' => 'Entertainment' ],
            [ 'name' => 'Health' ]
        ];

        foreach ( $data as  $datum )
        {
            Category::create($datum);
        }
    }
}
