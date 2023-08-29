<?php

namespace App\Service;

use App\Models\Post;
use App\Repository\PostFileRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostService implements ServiceInterface
{
    protected $postRepository;
    protected $userRepository;
    function __construct(PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function getAll(): array
    {
        return $this->postRepository->getAll();
    }

    public function getByID(int $id): array
    {
        return $this->postRepository->getByID($id);
    }

    public function create(Request $request): bool
    {
        DB::beginTransaction();
        try {
            $userId = Auth::user()->id;
            $data = $request->all();
            $file = $data['post_file'];
            $pathFile = $this->insertFileToStorage($file);
            $postData = [
                'user_id' => $userId,
                'content' => $data['content'] ?? '',
                'privacy_mode' => $data['privacy_mode']
            ];
            $postFileData = $pathFile;
            $this->postRepository->createPost($postData, $postFileData);
            DB::commit();
            return true;
        } catch (\Throwable  $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function updateByID(int $postId, Request $request): bool
    {
        DB::beginTransaction();
        try {
            $content = $request->input('content_upload');
            $version = $request->input('version');
            $data = [
                'content' => $content,
                'version' => $version + 1
            ];
            $this->postRepository->updateByID($postId, $data, $version);
            DB::commit();
            return true;
        } catch (\Throwable  $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteByID(int $id): bool
    {
        try {
            $result = $this->postRepository->deleteByID($id);
            return $result;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getPostFollowing(int $id): Collection
    {
        try {
            $listPost = $this->postRepository->getPostFollowing($id);
            $isUserLikePost = false;
            foreach ($listPost as $post) {
                if ($post->likes->count() != 0) {
                    foreach ($post->likes as $like) {
                        if ($like->user_id == $id) {
                            $isUserLikePost = true;
                        }
                        $post->isUserLikePost = $isUserLikePost;
                    }
                }
            }
            return $listPost;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getMorePostFollowing(int $id, int $currentPage): Collection
    {
        try {
            $listPost = $this->postRepository->getMorePostFollowing($id, $currentPage);
            $isUserLikePost = false;
            foreach ($listPost as $key => $post) {
                if ($post->likes->count() != 0) {
                    foreach ($post->likes as $like) {
                        if ($like->user_id == $id) {
                            $isUserLikePost = true;
                        }
                        $post->isUserLikePost = $isUserLikePost;
                    }
                }
                if (!Gate::allows('show-post', [$post, true, true])) {
                    unset($listPost[$key]);
                }
            }
            return $listPost;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }
    public function getMorePostFollowing2(int $id, int $currentPage): Collection
    {
        try {
            $listPost = $this->postRepository->getMorePostFollowing($id, $currentPage);
            return $listPost;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getPostByUserId(int $userID): Collection
    {
        try {
            $listPost = $this->postRepository->getPostByUserId($userID);
            return $listPost;
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
    // public function createListCommentsParent(Collection $listComment)
    // {
    //     for ($i = 0; $i < sizeof($listComment); $i++) {
    //         if (isset($listComment[$i])) {
    //             $comment = $listComment[$i];
    //         }
    //         else{
    //             continue;
    //         }
    //         $childComment = [];
    //         if (sizeof(explode('.', $comment->level_comment)) == 1) {
    //             for ($j = $i + 1; $j < sizeof($listComment); $j++) {
    //                 if (isset($listComment[$j])) {
    // if (Str::contains($listComment[$j]->level_comment, explode('.', $comment->level_comment))) {
    //     array_push($childComment, $listComment[$j]);
    //     $listComment->forget($j);
    // };
    //                 }
    //             }
    //         }
    //         $comment->child = $childComment;
    //     }
    //     return $listComment;
    // }

    public function getPostDetail(int $postID): Collection
    {
        try {
            $postDetail = $this->postRepository->getCommentByPostId($postID);
            $file = $postDetail[0]->files[0];
            $newPostDetail = $this->createListCommentsParent($postDetail[0]->comments);
            foreach ($newPostDetail as $key => $postDetail) {
                if (sizeof(explode('.', $postDetail->level_comment)) > 1) {
                    unset($newPostDetail[$key]);
                }
            }
            $newPostDetail[0]->file = $file;
            return $newPostDetail;
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function createListCommentsParent(Collection $listComment)
    {
        $commentMap = [];

        $sortedComments = $listComment->sortBy('level_comment');

        foreach ($sortedComments as $comment) {
            $level = sizeof(explode('.', $comment->level_comment));
            if (!isset($commentMap[$level])) {
                $commentMap[$level] = [];
            }
            $commentMap[$level][] = $comment;
        }
        $sortedComments = $sortedComments->map(function ($comment) use ($commentMap) {
            $level = sizeof(explode('.', $comment->level_comment));
            if ($level === 1) {
                $comment->child = $this->createNestedComments($comment, $commentMap);
            }
            return $comment;
        });
        return $sortedComments;
    }

    protected function createNestedComments($comment, $commentMap)
    {
        $childComments = [];
        $level = sizeof(explode('.', $comment->level_comment));
        if (isset($commentMap[$level + 1])) {
            foreach ($commentMap[$level + 1] as $childComment) {
                if (Str::contains($childComment->level_comment, explode('.', $comment->level_comment))) {
                    $childComment->child = $this->createNestedComments($childComment, $commentMap);
                    $childComments[] = $childComment;
                }
            }
        }
        return $childComments;
    }

    public function insertFileToStorage($file): string
    {
        try {
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::put('post/' . $fileName, $file->getContent());
            return $fileName;
        } catch (\Throwable  $e) {
            Log::error($e);
            return '';
        }
    }
}
