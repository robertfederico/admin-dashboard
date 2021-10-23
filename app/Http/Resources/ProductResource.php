<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $date_time = Carbon::parse($this->date_time);

        return [
            'id'          => $this->id,
            'name'        => ucwords($this->name),
            'category'    => $this->category,
            'description' => $this->description,
            'date_time'   => $date_time->format('M d, Y h:i a'),
        ];
    }
}
