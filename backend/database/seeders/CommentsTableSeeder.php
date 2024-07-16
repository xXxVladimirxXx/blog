<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['content' => 'Content comment content content content content content content content content 1', 'post_id' => 4, 'user_id' => 2],
            ['content' => 'Content comment content content content content content content content content 2', 'post_id' => 2, 'user_id' => 1],
            ['content' => 'Content comment content content content content content content content content 3', 'post_id' => 5, 'user_id' => 1],
            ['content' => 'Content comment content content content content content content content content 4', 'post_id' => 4, 'user_id' => 3],
            ['content' => 'Content comment content content content content content content content content 5', 'post_id' => 4, 'user_id' => 3],
            ['content' => 'Content comment content content content content content content content content 6', 'post_id' => 1, 'user_id' => 1],
        ];

        foreach ($items as $item) {
            Comment::create($item);
        }
    }
}
