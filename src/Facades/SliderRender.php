<?php

namespace Module\Slider\Facades;

use Illuminate\Support\Facades\Facade;

class SliderRender extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'slider.render';
    }
}
