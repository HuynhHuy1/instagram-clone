<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Service\CommentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

/**
 * Summary of CommentController
 */
class CommentController extends Controller
{
    protected $commentService;
    /**
     * Summary of __construct
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Summary of create
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'content' => 'required | max:225 '
            ]);
            $response = $this->commentService->create($request);
            return $response;
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e
            ]);
        }

    }

    /**
     * Summary of delete
     * @param int $commentId
     * @return JsonResponse
     */
    public function delete(int $commentId): JsonResponse
    {
        try {
            $comment = Comment::findOrFail($commentId);
            Gate::authorize('delete', $comment);
            $result = $this->commentService->deleteByID($commentId);
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xoá bình luận thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Xoá bình luận thất bại'
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);;
        }
    }
}
