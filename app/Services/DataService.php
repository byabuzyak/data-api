<?php

namespace App\Services;

use App\Http\Resources\DataResource;
use App\Models\Data;
use App\Repositories\DataRepository;
use App\Repositories\Interfaces\DataRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DataService
 * @package App\Services
 */
class DataService
{
    /**
     * @var DataRepository
     */
    public $data;

    /**
     * DataService constructor.
     * @param DataRepositoryInterface $data
     */
    public function __construct(DataRepositoryInterface $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $uid
     * @return JsonResource
     */
    public function getById(string $uid): JsonResource
    {
        return
            $this->data->getById($uid);
    }

    /**
     * @param array $data
     * @return JsonResource
     */
    public function store(array $data): JsonResource
    {
        return new DataResource(
            Data::create($data)
        );
    }
}
