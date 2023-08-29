<?php

namespace App\Service;

use App\Models\Follow;
use App\Repository\FollowRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowService
{
    protected $followRepository;
    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function toggleFollow(int $userId, int $followeId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $followModel = $this->followRepository->getOneByArray([
                'follower' => $followeId,
                'following' => $userId
            ]);
            if ($followModel == null) {
                $this->followRepository->create([
                    'follower' => $followeId,
                    'following' => $userId,
                ]);
                DB::commit();
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'add'
                    ]
                );
            } else {
                $this->followRepository->deleteByID($followModel->id);
                DB::commit();
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'delete'
                    ]
                );
            }
        } catch (\Throwable  $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
