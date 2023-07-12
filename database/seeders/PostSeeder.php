<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

       // \DB::table('posts')->delete();

        foreach (range(1, 45) as $value) {
            DB::table('posts')->Insert([
                'title' => 'Dummy post '.rand(1,99) ,
                'description' =>'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available',
                'category_id' => rand(1,4),
                'posted_by' =>rand(1,4),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
