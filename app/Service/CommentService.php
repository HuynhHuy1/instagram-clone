<?php

namespace App\Service;

use App\Repository\CommentRepository;
use App\Repository\LikeRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentService implements ServiceInterface
{
    protected $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getAll()
    {
    }

    public function getByID(int $id)
    {
    }

    public function create(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $content = $request->content;
            $userID = $request->user()->id;
            $postId = $request->post_id;
            $isCreateSuccess = $this->commentRepository->create(
                [
                    'content' => $content,
                    'user_id' => $userID,
                    'post_id' => $postId
                ]
            );
            if ($isCreateSuccess) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Bình luận thành công',
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Bình luận thất bại',
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateByID(int $id, Request $request)
    {
    }

    public function deleteByID(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->commentRepository->deleteByID($id);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
