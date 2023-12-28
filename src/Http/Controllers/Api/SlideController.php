<?php

namespace Module\Slide\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Module\Slide\Http\Resources\SlideResource;
use Module\Slide\Models\Slide;

class SlideController extends Controller
{
  /**
   * @return array
   */
  public function index()
  {
    $slide = Slide::where('slug', 'home-page')->first();
    return new SlideResource($slide);
  }
}
