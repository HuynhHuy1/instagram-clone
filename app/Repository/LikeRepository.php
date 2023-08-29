<?php

namespace App\Repository;

use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeRepository
{

    public function getLike(int $userID, int $postID): bool
    {
        $likeModel = Like::where('user_id', '=', $userID)
            ->where('post_id', '=', $postID)
            ->get();
        if ($likeModel->isEmpty()) {
            return false;
        }
        return true;
    }
    public function insertLike(int $userID, int $postID): bool
    {
        DB::beginTransaction();
        try {
            Like::create([
                'user_id' => $userID,
                'post_id' => $postID,
            ]);
            DB::commit();
            return true;
        } catch (\Throwable  $e) {
            Log::error($e);
            DB::rollBack();
            return false;
        }
    }

    public function deleteLike(int $userID, int $postID): bool
    {
        DB::beginTransaction();
        try {
            Like::where('user_id', '=', $userID)
                ->where('post_id', '=', $postID)
                ->delete();
            DB::commit();
            return true;
        } catch (\Throwable  $e) {
            Log::error($e);
            DB::rollBack();
            return false;
        }
    }
}
