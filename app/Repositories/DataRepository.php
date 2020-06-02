<?php

namespace App\Repositories;

use App\Http\Resources\DataResource;
use App\Models\Data;
use App\Repositories\Interfaces\DataRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DataRepository
 * @package App\Repositories
 */
class DataRepository implements DataRepositoryInterface
{
    /**
     * @var Data
     */
    public $model;

    /**
     * DataRepository constructor.
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->model = $data;
    }

    /**
     * @param string $uid
     * @return JsonResource
     */
    public function getById(string $uid): JsonResource
    {
        return
            new DataResource(
                $this->model
                    ->where('page_uid', $uid)
                    ->first()
            );
    }
}
