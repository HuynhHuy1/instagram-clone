<?php

namespace App\Service;

use App\Models\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileService implements ServiceInterface
{
    protected $userRepository;
    protected $postRepository;

    function __construct(UserRepository $userRepository, PostRepository $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }
    function getAll()
    {
    }

    function getByID(int $userId): array
    {
        try {
            $isFollwed = false;
            $userLoginId = Auth::user()->id;
            $isUserLogin = ($userLoginId === $userId);
            $listPostByID = $this->postRepository->getPostByUserId($userId);
            $listFollow = $this->userRepository->getFollower($userLoginId);
            foreach ($listFollow as $follow) {
                if ($follow->id == $userId) {
                    $isFollwed = true;
                    break;
                };
            }
            $listFiltered = array_filter($listPostByID->all(), function ($post) use ($isFollwed, $isUserLogin) {
                return Gate::allows('show-post', [$post, $isFollwed, $isUserLogin]);
            });
            return [
                'listPost' => $listFiltered,
                'isFollowed' => $isFollwed,
                'isUserLogin' => $isUserLogin
            ];
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
    function search(string $userName): Collection
    {
        try {
            $users = $this->userRepository->getUserByName($userName);
            return $users;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }


    function create(Request $request)
    {
    }

    function updateByID(int $id, Request $request): bool
    {
        try {
            $oldPassword = $request->input('old_password');
            $password = $request->input('password');
            if (Hash::check($oldPassword, Auth::user()->getAuthPassword())) {
                User::where([
                    'id' => $id,
                ])->update([
                    'password' => Hash::make($password),
                ]);
                return true;
            } else {
                return false;
            }
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    function deleteByID(int $id): bool
    {
        return true;
    }
}
