<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Interface DataRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface DataRepositoryInterface
{
    public function getById(string $uid): JsonResource;
}
