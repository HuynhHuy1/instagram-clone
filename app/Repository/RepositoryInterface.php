<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function getAll() : array;

    public function getByID(int $id) ;

    public function create(array $data) : bool;

    public function updateByID(int $id,array $data,int $version);

    public function deleteByID(int $id) : bool;
}
