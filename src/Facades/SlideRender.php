<?php

namespace Module\Slide\Facades;

use Illuminate\Support\Facades\Facade;

class SlideRender extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Slide.render';
    }
}
