<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (empty($this->resource)) {
            return [];
        }

        return [
            'id'       => $this->id,
            'page_uid' => $this->page_uid,
            'name'     => $this->name,
            'amount'   => $this->amount,
            'currency' => $this->currency,
            'created'  => $this->created_at
        ];
    }
}
