<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'Title 1', 'content' => 'Content content content content content content content content content 1', 'user_id' => 1],
            ['title' => 'Title 2', 'content' => 'Content content content content content content content content content 2', 'user_id' => 1],
            ['title' => 'Title 3', 'content' => 'Content content content content content content content content content 3', 'user_id' => 1],
            ['title' => 'Title 4', 'content' => 'Content content content content content content content content content 4', 'user_id' => 1],
            ['title' => 'Title 5', 'content' => 'Content content content content content content content content content 5', 'user_id' => 1],
            ['title' => 'Title 6', 'content' => 'Content content content content content content content content content 6', 'user_id' => 1],
        ];

        foreach ($items as $item) {
            Post::create($item);
        }
    }
}
