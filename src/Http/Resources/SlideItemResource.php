<?php

namespace Module\Slide\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideItemResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'name' => $this->name,
      'description' => $this->description,
      'image' => $this->image ? $this->image->url : '',
      'link' => $this->link,
    ];
  }
}
