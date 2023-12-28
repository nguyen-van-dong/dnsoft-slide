<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

if (!function_exists('get_slide_layout_options'))
{
  function get_slide_layout_options(): array
  {
    $options = [];

    $layouts = config('slide.layouts');
    foreach ($layouts as $layout) {
      $options[] = [
        'value' => $layout,
        'label' => get_slide_layout_label($layout),
      ];
    }
    return $options;
  }
}

if (!function_exists('get_slide_layout_label'))
{
  function get_slide_layout_label($layout)
  {
    $langKey = "slide::slide.layouts.{$layout}";
    return Lang::has($langKey) ? Lang::get($langKey) : Str::ucfirst($layout);
  }
}
