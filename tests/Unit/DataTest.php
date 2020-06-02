<?php

namespace Tests\Unit;

use App\Models\Data;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataTest extends TestCase
{
    use RefreshDatabase;

    public function testGetById()
    {
        $data     = factory(Data::class)->create();
        $response = $this->json('POST', '/api', [
            'jsonrpc' => '2.0',
            'method'  => 'getById',
            'params'  => [
                'page_uid' => $data->page_uid
            ],
            'id'      => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'jsonrpc' => '2.0',
                'result'  => [
                    'id'       => $data->id,
                    'page_uid' => $data->page_uid,
                    'name'     => $data->name,
                    'amount'   => $data->amount,
                    'currency' => $data->currency
                ]
            ]);
    }

    public function testStoreData()
    {
        $data     = factory(Data::class)->make();
        $response = $this->json('POST', '/api', [
            'jsonrpc' => '2.0',
            'method'  => 'store',
            'params'  => $data,
            'id'      => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'jsonrpc' => '2.0',
                'result'  => [
                    'page_uid' => $data->page_uid,
                    'name'     => $data->name,
                    'currency' => $data->currency,
                    'amount'   => $data->amount
                ]
            ]);
    }

    public function testInvalidAction()
    {
        $data     = factory(Data::class)->create();
        $response = $this->json('POST', '/api', [
            'jsonrpc' => '2.0',
            'method'  => 'all',
            'params'  => [],
            'id'      => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'jsonrpc',
                'error'
            ]);
    }

    public function testValidateInput()
    {
        $response = $this->json('POST', '/api', [
            'jsonrpc' => '2.0',
            'method'  => 'store',
            'params'  => [
                'page_uid' => '',
                'name'     => 'test',
                'amount'   => -123,
                'currency' => 'STR'
            ],
            'id'      => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'jsonrpc' => '2.0',
                'error'   => 'Invalid params'
            ]);
    }
}
