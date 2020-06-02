<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonRpcController;
use App\Services\DataService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class DataController extends Controller
{
    use JsonRpcController;

    /**
     * @var DataService
     */
    public $dataService;

    /**
     * DataController constructor.
     * @param DataService $dataService
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * @param array $data
     * @return JsonResource
     */
    public function getById(array $data): JsonResource
    {
        $this->validateData($data, [
            'page_uid' => 'required|string'
        ]);

        return
            $this->dataService->getById($data['page_uid']);
    }

    /**
     * @param array $data
     * @return JsonResource
     * @throws \App\Exceptions\JsonRpcException
     */
    public function store(array $data): JsonResource
    {
        $this->validateData($data, [
            'page_uid' => 'required|unique:data,page_uid',
            'name'     => 'required|string',
            'amount'   => 'required|integer',
            'currency' => [
                'required',
                Rule::in(['USD', 'EUR', 'RUR', 'CHF'])
            ],
        ]);

        return
            $this->dataService->store($data);
    }
}
