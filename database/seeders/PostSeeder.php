<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'content' => 'Song o day dep qua',
                'user_id' => 105,
                'created_at' => '2023-07-10 21:24:55',
            ],
            [
                'content' => 'Imag 1',
                'user_id' => 49,
                'created_at' => '2023-07-11 15:06:30',
            ],
            [
                'content' => 'Image 2',
                'user_id' => 49,
                'created_at' => '2023-07-11 15:06:46',
            ],
            [
                'content' => 'Image 4',
                'user_id' => 49,
                'created_at' => '2023-07-11 15:06:55',
            ],
            [
                'content' => 'Image 5',
                'user_id' => 49,
                'created_at' => '2023-07-11 15:07:09',
            ],
            [
                'content' => 'Image 1',
                'user_id' => 51,
                'created_at' => '2023-07-11 15:08:09',
            ],
            [
                'content' => 'Image 2',
                'user_id' => 51,
                'created_at' => '2023-07-11 15:08:21',
            ],
            [
                'content' => 'Image 3',
                'user_id' => 51,
                'created_at' => '2023-07-11 15:08:32',
            ],
            [
                'content' => 'Image 4',
                'user_id' => 51,
                'created_at' => '2023-07-11 15:08:46',
            ],
            [
                'content' => 'Image 1',
                'user_id' => 48,
                'created_at' => '2023-07-11 15:09:19',
            ],
            [
                'content' => 'Image 2',
                'user_id' => 48,
                'created_at' => '2023-07-11 15:09:29',
            ],
            [
                'content' => 'Image 5',
                'user_id' => 48,
                'created_at' => '2023-07-11 15:09:37',
            ],
            [
                'content' => 'Image 7',
                'user_id' => 48,
                'created_at' => '2023-07-11 15:09:52',
            ],
            [
                'content' => 'Image 1',
                'user_id' => 50,
                'created_at' => '2023-07-11 15:10:43',
            ],
            [
                'content' => 'Image 2',
                'user_id' => 50,
                'created_at' => '2023-07-11 15:10:51',
            ],
            [
                'content' => 'Image 4',
                'user_id' => 50,
                'created_at' => '2023-07-11 15:10:58',
            ],
            [
                'content' => 'Image 5',
                'user_id' => 50,
                'created_at' => '2023-07-11 15:11:08',
            ],
            [
                'content' => 'Image 4',
                'user_id' => 50,
                'created_at' => '2023-07-11 15:11:21',
            ],
        ];
        Post::insert($data);
    }
}
