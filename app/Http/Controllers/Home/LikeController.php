<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Service\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $likeService;
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggleLike(int $postID): JsonResponse
    {
        $userID = Auth::user()->id;
        $response = $this->likeService->toggleLike($userID, $postID);
        return $response;
    }
}
