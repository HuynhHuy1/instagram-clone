<?php

namespace App\Service;

use App\Repository\LikeRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LikeService
{
    protected $likeRepository;
    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function toggleLike(int $userID, int $postID): JsonResponse
    {
        DB::beginTransaction();
        try {
            $isLikeEmpty = $this->likeRepository->getLike($userID, $postID);
            if ($isLikeEmpty) {
                $this->likeRepository->deleteLike($userID, $postID);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'unlike'
                ]);
            } else {
                $this->likeRepository->insertLike($userID, $postID);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'like'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
