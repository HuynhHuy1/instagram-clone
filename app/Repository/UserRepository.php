<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class UserRepository extends RepositoryAbstract
{
    function getModel(): string
    {
        return User::class;
    }

    function getFollower(int $id): Collection
    {
        $users = User::with('follow')
            ->whereHas('follow', function ($query) use ($id) {
                $query->where('following', $id);
            })
            ->get();
        return $users;
    }

    function getUserByName(string $userName): Collection
    {
        $users = User::where('name', 'like', '%' . $userName . '%')
            ->get();
        return $users;
    }
}
