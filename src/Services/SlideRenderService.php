<?php

namespace Module\Slide\Services;

use Module\Slide\Repositories\SlideItemRepositoryInterface;
use Module\Slide\Repositories\SlideRepositoryInterface;
use Module\Slide\Repositories\Eloquents\SlideItemRepository;
use Module\Slide\Repositories\Eloquents\SlideRepository;

class SlideRenderService
{
  /**
   * @var SlideRepositoryInterface|SlideRepository
   */
  protected $SlideRepository;

  /**
   * @var SlideItemRepositoryInterface|SlideItemRepository
   */
  protected $SlideItemRepository;

  public function __construct(
    SlideRepositoryInterface $SlideRepository,
    SlideItemRepositoryInterface $SlideItemRepository
  ) {
    $this->SlideRepository = $SlideRepository;
    $this->SlideItemRepository = $SlideItemRepository;
  }

  public function render($SlideKey, $layout = null)
  {
    try {
      $Slide = $this->findSlide($SlideKey);
    } catch (\Exception $e) {
      return "Slide <strong>{$SlideKey}</strong> not found!";
    }
     

    $layout = $layout ?: "Slide::layouts." . $Slide->layout;

    $SlideItems = $this->SlideItemRepository->allActiveOfSlide($Slide->id);

    return view($layout)->with([
      'Slide'      => $Slide,
      'SlideItems' => $SlideItems,
    ]);
  }

  protected function findSlide($SlideKey)
  {
    if (is_numeric($SlideKey)) {
      $Slide = $this->SlideRepository->find($SlideKey);
    } else {
      $Slide = $this->SlideRepository->findBySlug($SlideKey);
    }
    return $Slide;
  }
}
