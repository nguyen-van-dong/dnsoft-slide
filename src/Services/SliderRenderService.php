<?php

namespace Module\Slider\Services;

use Module\Slider\Repositories\SliderItemRepositoryInterface;
use Module\Slider\Repositories\SliderRepositoryInterface;
use Module\Slider\Repositories\Eloquents\SliderItemRepository;
use Module\Slider\Repositories\Eloquents\SliderRepository;

class SliderRenderService
{
  /**
   * @var SliderRepositoryInterface|SliderRepository
   */
  protected $sliderRepository;

  /**
   * @var SliderItemRepositoryInterface|SliderItemRepository
   */
  protected $sliderItemRepository;

  public function __construct(
    SliderRepositoryInterface $sliderRepository,
    SliderItemRepositoryInterface $sliderItemRepository
  ) {
    $this->sliderRepository = $sliderRepository;
    $this->sliderItemRepository = $sliderItemRepository;
  }

  public function render($sliderKey, $layout = null)
  {
    try {
      $slider = $this->findSlider($sliderKey);
    } catch (\Exception $e) {
      return "Slider <strong>{$sliderKey}</strong> not found!";
    }

    $layout = $layout ?: "slider::layouts." . $slider->layout;

    $sliderItems = $this->sliderItemRepository->allActiveOfSlider($slider->id);

    return view($layout)->with([
      'slider'      => $slider,
      'sliderItems' => $sliderItems,
    ]);
  }

  protected function findSlider($sliderKey)
  {
    if (is_numeric($sliderKey)) {
      $slider = $this->sliderRepository->find($sliderKey);
    } else {
      $slider = $this->sliderRepository->findBySlug($sliderKey);
    }
    return $slider;
  }
}
