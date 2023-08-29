<?php

namespace App\Repository;

use App\Models\Follow;
use Illuminate\Database\Eloquent\Collection;
use SebastianBergmann\Comparator\Exception;

class FollowRepository extends RepositoryAbstract
{
    public function getModel(): string
    {
        return Follow::class;
    }

    // public function getFollow(int $userId, int $userFollowing): Collection
    // {
    //     try {
    //         $user = Follow::where([
    //             'following' => $userId,
    //             'follower' => $userFollowing,
    //         ])->get();
    //         return $user;
    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
}
