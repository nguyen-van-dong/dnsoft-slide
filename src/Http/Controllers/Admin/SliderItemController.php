<?php

namespace Module\Slider\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Slider\Http\Requests\SliderItemRequest;
use Module\Slider\Models\SliderItem;
use Module\Slider\Repositories\Eloquents\SliderItemRepository;
use Module\Slider\Repositories\Eloquents\SliderRepository;
use Module\Slider\Repositories\SliderItemRepositoryInterface;
use Module\Slider\Repositories\SliderRepositoryInterface;

class SliderItemController extends Controller
{
  /**
   * @var SliderItemRepositoryInterface|SliderItemRepository
   */
  protected $sliderItemRepository;

  /**
   * @var SliderRepositoryInterface|SliderRepository
   */
  protected $sliderRepository;

  public function __construct(
    SliderItemRepositoryInterface $sliderItemRepository,
    SliderRepositoryInterface $sliderRepository
  ) {
    $this->sliderItemRepository = $sliderItemRepository;
    $this->sliderRepository = $sliderRepository;
  }

  public function index($sliderId)
  {
    MenuAdmin::activeMenu('slider');

    $slider = $this->sliderRepository->find($sliderId);
    $items = $this->sliderItemRepository->allOfSlider($sliderId);

    return view("slider::admin.slider-item.index", compact('items', 'slider'));
  }

  public function create(Request $request)
  {
    MenuAdmin::activeMenu('slider');

    $slider_id = $request->input('slider_id');

    $item = new SliderItem();
    $item->slider_id = $slider_id;
    $item->is_active = true;
    $item->sort_order = $this->sliderItemRepository->getMaxSortOrderOfSlider($slider_id) + 1;

    $slider = $this->sliderRepository->find($slider_id);
    return view("slider::admin.slider-item.create", compact('item', 'slider'));
  }

  public function store(SliderItemRequest $request)
  {
    $item = $this->sliderItemRepository->create($request->all());

    if ($request->input('continue')) {
      return redirect()
        ->route('slider.admin.slider-item.edit', $item->id)
        ->with('success', __('slider::slider-item.notification.created'));
    }

    return redirect()
      ->route('slider.admin.slider-item.index', $item->slider_id)
      ->with('success', __('slider::slider-item.notification.created'));
  }

  public function edit($id)
  {
    MenuAdmin::activeMenu('slider');

    $item = $this->sliderItemRepository->find($id);
    $slider = $item->slider;
    return view("slider::admin.slider-item.edit", compact('item', 'slider'));
  }

  public function update(SliderItemRequest $request, $id)
  {
    /** @var SliderItem $item */
    $item = $this->sliderItemRepository->updateById($request->all(), $id);

    if ($request->input('continue')) {
      return redirect()
        ->route('slider.admin.slider-item.edit', $item->id)
        ->with('success', __('slider::slider-item.notification.updated'));
    }

    return redirect()
      ->route('slider.admin.slider-item.index', $item->slider_id)
      ->with('success', __('slider::slider-item.notification.updated'));
  }

  public function destroy($id, Request $request)
  {
    $item = $this->sliderItemRepository->find($id);
    $this->sliderItemRepository->delete($id);

    if ($request->ajax()) {
      Session::flash('success', __('slider::slider-item.notification.deleted'));
      return response()->json([
        'success' => true,
      ]);
    }

    return redirect()
      ->route('slider.admin.slider-item.index', $item->slider_id)
      ->with('success', __('slider::slider-item.notification.deleted'));
  }
}
