<?php

namespace Database\Seeders;

use App\Models\Follow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'follower' => 1,
                'following' => 49,
            ],
            [
                'follower' => 48,
                'following' => 1,
            ],
            [
                'follower' => 49,
                'following' => 1,
            ],
            [
                'follower' => 49,
                'following' => 51,
            ],
            [
                'follower' => 50,
                'following' => 48,
            ],
            [
                'follower' => 50,
                'following' => 49,
            ],
            [
                'follower' => 51,
                'following' => 1,
            ],
            [
                'follower' => 51,
                'following' => 49,
            ],
        ];
        Follow::insert($data);
    }
}
