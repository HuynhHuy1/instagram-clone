<?php

namespace App\Repository;

use App\Models\Comment;

class CommentRepository extends RepositoryAbstract
{
    public function getModel(): string
    {
        return Comment::class;
    }
}
