<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Service\PostService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): View
    {
        try {
            $userId = Auth::user()->id;
            $listPost = $this->postService->getMorePostFollowing2($userId, 1);
            return view('home.home', ['listPost' => $listPost]);
        } catch (\Throwable $e) {
            Log::error($e);
            return view('home.home')->with('error', 'Đăng bài viết không thành công');
        }
    }

    public function getMore(Request $request): JsonResponse
    {
        try {
            $userId = Auth::user()->id;
            $currentPage = $request->input('current_page');
            $listPost = $this->postService->getMorePostFollowing2($userId, $currentPage);
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $listPost,
                    'message' => 'Lấy danh sách thành công'
                ]
            );
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e 
            ]);
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $this->postService->create($request);
            return redirect()->route('home')
                ->with('success', 'Đăng bài viết thành công');
        } catch (\Exception $e) {
            Log::error($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, int $postId): RedirectResponse
    {
        $request->validate([
            'content_upload' => 'max:225'
        ]);
        try {
            $post = Post::findOrFail($postId);
            $this->authorize('update', $post);
            $result = $this->postService->updateByID($postId, $request);
            if ($result) {
                return redirect()->route('home')
                    ->with('success', 'Bài viết đã được cập nhật thành công');
            } else {
                return back()->withInput()->with('error', 'Cập nhật bài viết thất bại');
            }
        } catch (\Exception $e) {
            Log::error($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            $this->authorize('delete', $post);
            $result = $this->postService->deleteByID($id);
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xoá bài viết thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Xoá bài viết thất bại'
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getInfoPostDetail(int $postId): JsonResponse
    {
        try {
            $postDetail = $this->postService->getPostDetail($postId);
            return response()->json([
                'status' => 'success',
                'data' => $postDetail,
                'message' => 'Lấy thành công bình luận'
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }
}
