<?php

namespace App\Service;
use Illuminate\Http\Request;

interface ServiceInterface
{
    public function getAll();

    public function getByID(int $id);

    public function create(Request $request);

    public function updateByID(int $id, Request $request);

    public function deleteByID(int $id) : bool;
}
