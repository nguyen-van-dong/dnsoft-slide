<?php

namespace Module\Slide\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Slide\Http\Requests\SlideItemRequest;
use Module\Slide\Models\SlideItem;
use Module\Slide\Repositories\Eloquents\slideItemRepository;
use Module\Slide\Repositories\Eloquents\SlideRepository;
use Module\Slide\Repositories\SlideItemRepositoryInterface;
use Module\Slide\Repositories\SlideRepositoryInterface;

class SlideItemController extends Controller
{
  /**
   * @var SlideItemRepositoryInterface|slideItemRepository
   */
  protected $slideItemRepository;

  /**
   * @var SlideRepositoryInterface|SlideRepository
   */
  protected $slideRepository;

  public function __construct(
    slideItemRepositoryInterface $slideItemRepository,
    SlideRepositoryInterface $slideRepository
  ) {
    $this->slideItemRepository = $slideItemRepository;
    $this->slideRepository = $slideRepository;
  }

  public function index($slideId)
  {
    MenuAdmin::activeMenu('slide');

    $slide = $this->slideRepository->find($slideId);
    $items = $this->slideItemRepository->allOfSlide($slideId);

     
    return view("slide::admin.slide-item.index", compact('items', 'slide'));
  }

  public function create(Request $request)
  {
    MenuAdmin::activeMenu('slide');

    $slideId = $request->input('slide_id');

    $item = new SlideItem();
    $item->slide_id = $slideId;
    $item->is_active = true;
    $item->sort_order = $this->slideItemRepository->getMaxSortOrderOfSlide($slideId) + 1;

    $slide = $this->slideRepository->find($slideId);
     
    return view("slide::admin.slide-item.create", compact('item', 'slide'));
  }

  public function store(SlideItemRequest $request)
  {
    $item = $this->slideItemRepository->create($request->all());

    if ($request->input('continue')) {
      return redirect()
        ->route('slide.admin.slide-item.edit', $item->id)
        ->with('success', __('slide::Slide-item.notification.created'));
    }

    return redirect()
      ->route('slide.admin.slide-item.index', $item->slide_id)
      ->with('success', __('slide::Slide-item.notification.created'));
  }

  public function edit($id)
  {
    MenuAdmin::activeMenu('slide');

    $item = $this->slideItemRepository->find($id);
    $slide = $item->slide;
     
    return view("slide::admin.slide-item.edit", compact('item', 'slide'));
  }

  public function update(SlideItemRequest $request, $id)
  {
    /** @var SlideItem $item */
    $item = $this->slideItemRepository->updateById($request->all(), $id);

    if ($request->input('continue')) {
      return redirect()
        ->route('slide.admin.slide-item.edit', $item->id)
        ->with('success', __('slide::Slide-item.notification.updated'));
    }

    return redirect()
      ->route('slide.admin.slide-item.index', $item->slide_id)
      ->with('success', __('slide::Slide-item.notification.updated'));
  }

  public function destroy($id, Request $request)
  {
    $item = $this->slideItemRepository->find($id);
    $this->slideItemRepository->delete($id);

    if ($request->ajax()) {
      Session::flash('success', __('slide::Slide-item.notification.deleted'));
      return response()->json([
        'success' => true,
      ]);
    }

    return redirect()
      ->route('slide.admin.slide-item.index', $item->slide_id)
      ->with('success', __('slide::Slide-item.notification.deleted'));
  }
}
