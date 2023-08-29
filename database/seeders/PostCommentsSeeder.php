<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'content' => 'Anh dep qua',
                'user_id' => 1,
                'post_id' => 117,
            ],
            [
                'content' => 'hello huy',
                'user_id' => 1,
                'post_id' => 121,
            ],
            [
                'content' => 'hello huy 2',
                'user_id' => 1,
                'post_id' => 121,
            ],
            [
                'content' => 'hello huy 3',
                'user_id' => 1,
                'post_id' => 121,
            ],
            [
                'content' => 'hello huy 4',
                'user_id' => 1,
                'post_id' => 121,
            ],
        ];
        Comment::insert($data);
    }
}
