<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository extends RepositoryAbstract
{
    public function getModel(): string
    {
        return Post::class;
    }

    public function createPost(array $postData, string $postFileData): bool
    {
        DB::beginTransaction();
        try {
            $postId = Post::create($postData);
            PostFile::insert([
                'post_file' => $postFileData,
                'post_id' => $postId->id,
            ]);
            Log::info("Post added successfully. Post ID: {$postId->id}");
            DB::commit();
            return true;
        } catch (\Throwable  $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function getByID(int $postID): array
    {
        try {
            $post = DB::select(
                "   SELECT  p.id ,u.avatar , u.name , p.user_id , p.content , pf.post_file
                    FROM posts p  
                    INNER JOIN users u ON u.id = p.user_id  
                    LEFT JOIN post_files pf on pf.post_id = p.id
                    WHERE p.id = $postID "
            );
            return $post;
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function getPostFollowing(int $id): Collection
    {
        try {
            $posts = Post::with([
                'comments',
                'likes',
                'files',
                'user',
                'user.follow'
            ])->whereHas('user.follow', function ($query) use ($id) {
                $query->where('following', $id);
            })
                ->orWhere(function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
            return $posts;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getMorePostFollowing(int $id, int $currentPage): Collection
    {
        try {
            $posts = Post::with([
                'comments',
                'likes',
                'files',
                'user',
                'user.follow'
            ])->whereHas('user.follow', function ($query) use ($id) {
                $query->where('following', $id);
            })
                ->orWhere(function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->orderBy('created_at', 'desc')
                ->skip(($currentPage - 1) * 4)
                ->take(4)
                ->get();
            return $posts;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getPostByUserId(int $userId): Collection
    {
        try {
            $listPost = Post::with([
                'user',
                'likes',
                'comments',
                'files',
                'user.follow',
            ])->where('user_id', '=', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
            return $listPost;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getCommentByPostId(int $postId): Collection
    {
        try {
            $listComment = Post::with([
                'user',
                'files',
                'comments.user',
                'likes',
                'comments'
            ])->where('id', '=', $postId)
                ->get();
            return $listComment;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }
}
