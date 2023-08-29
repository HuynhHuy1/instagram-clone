<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Service\FollowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FollowController extends Controller
{
    protected $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    public function toggleFollowing(int $followerId): JsonResponse
    {
        try {
            $userId = Auth::user()->id;
            $result = $this->followService->toggleFollow($userId,$followerId);
            return $result;
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => 'Có lỗi khi theo dõi'
            ]);
        }
    }
}
