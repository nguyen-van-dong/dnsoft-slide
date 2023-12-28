<?php

namespace Module\Slide\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    $slideItems = $this->slideItems()->where('is_active', true)->get();
    return [
      'name' => $this->name,
      'items' => SlideItemResource::collection($slideItems)
    ];
  }
}
