<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class RepositoryAbstract implements RepositoryInterface
{

    protected $model;

    public function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel(): string;

    public function setModel(): void
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    public function getAll(): array
    {
        return $this->model::all();
    }

    public function getByID(int $id): array
    {
        return $this->model::find($id);
    }

    public function getOneByArray(array $data)
    {
        return $this->model::where([
            'following' => $data['following'],
            'follower' => $data['follower'],
        ])->first();
    }

    public function create(array $data): bool
    {
        try {
            $this->model::create($data);
            return true;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }
    public function updateByID(int $id, array $data, int $version): void
    {
        try {
            $result = $this->model::where([
                'id' => $id,
                'version' => $version,
            ])->update($data);
            if ($result == 0) {
                throw new Exception('Đã có người thay đổi bài viết');
            }
            Log::info('Dữ liệu đã được cập nhật thành công.', [
                'model' => get_class($this->model),
                'id' => $id,
                'data' => $data,
            ]);
        } catch (QueryException $e) {
            Log::error($e);
            throw $e;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function deleteByID(int $id): bool
    {
        try {
            $result = $this->model::findOrFail($id);
            $result->delete();
            Log::info('Dữ liệu đã được thành công.', [
                'model' => get_class($this->model),
                'id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
