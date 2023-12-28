<?php

namespace Module\Slide\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Slide\Http\Requests\SlideRequest;
use Module\Slide\Models\Slide;
use Module\Slide\Repositories\SlideItemRepositoryInterface;
use Module\Slide\Repositories\SlideRepositoryInterface;
use Module\Slide\Repositories\Eloquents\SlideRepository;

class SlideController extends Controller
{
  /**
   * @var SlideRepositoryInterface|SlideRepository
   */
  private $slideRepository;
  /**
   * @var SlideItemRepositoryInterface
   */
  private $slideItemRepository;

  public function __construct(
    SlideRepositoryInterface $slideRepository,
    SlideItemRepositoryInterface $slideItemRepository)
  {
    $this->slideRepository = $slideRepository;
    $this->slideItemRepository = $slideItemRepository;
  }

  public function index(Request $request)
  {
    $items = $this->slideRepository->paginate($request->input('max', 20));
     
    return view("slide::admin.slide.index", compact('items'));
  }

  public function create()
  {
    MenuAdmin::activeMenu('slide');

    $item = new Slide();
    $item->is_active = true;
    $item->layout = config('slide.default');
     
    return view("slide::admin.slide.create", compact('item'));
  }

  public function store(SlideRequest $request)
  {
    $item = $this->slideRepository->createWithAuthor($request->all());

    if ($request->input('continue')) {
      return redirect()
        ->route('slide.admin.slide.edit', $item->id)
        ->with('success', __('slide::slide.notification.created'));
    }

    return redirect()
      ->route('slide.admin.slide.index')
      ->with('success', __('slide::slide.notification.created'));
  }

  public function edit($id)
  {
    MenuAdmin::activeMenu('Slide');

    $item = $this->slideRepository->find($id);
    $items = $this->slideItemRepository->allOfSlide($id);
    $slide = $item;
     
    return view("slide::admin.slide.edit", compact('item', 'items', 'slide'));
  }

  public function update(SlideRequest $request, $id)
  {
    $item = $this->slideRepository->updateById($request->all(), $id);

    if ($request->input('continue')) {
      return redirect()
        ->route('slide.admin.slide.edit', $item->id)
        ->with('success', __('slide::slide.notification.updated'));
    }

    return redirect()
      ->route('slide.admin.slide.index')
      ->with('success', __('slide::slide.notification.updated'));
  }

  public function destroy($id, Request $request)
  {
    $this->slideRepository->delete($id);

    if ($request->ajax()) {
      Session::flash('success', __('slide::slide.notification.deleted'));
      return response()->json([
        'success' => true,
      ]);
    }

    return redirect()
      ->route('slide.admin.Slide.index')
      ->with('success', __('slide::slide.notification.deleted'));
  }
}
