<?php

namespace Module\Slide;

use DnSoft\Acl\Facades\Permission;
use DnSoft\Core\Support\BaseModuleServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Module\Slide\Facades\SlideRender;
use Module\Slide\Models\Slide;
use Module\Slide\Models\SlideItem;
use Module\Slide\Repositories\Eloquents\SlideItemRepository;
use Module\Slide\Repositories\Eloquents\SlideRepository;
use Module\Slide\Repositories\SlideItemRepositoryInterface;
use Module\Slide\Repositories\SlideRepositoryInterface;
use Module\Slide\Services\SlideRenderService;

class SlideServiceProvider extends BaseModuleServiceProvider
{
  public function getModuleNamespace(): string
  {
    return 'slide';
  }

  public function register()
  {
    parent::register();

    $this->app->singleton(SlideItemRepositoryInterface::class, function () {
      return new SlideItemRepository(new SlideItem());
    });

    $this->app->singleton(SlideRepositoryInterface::class, function () {
      return new SlideRepository(new Slide());
    });

    $this->app->singleton('slide.render', SlideRenderService::class);
  }

  public function boot()
  {
    parent::boot();
    $this->registerAdminMenu();
    $this->registerMiddlewares();
    require_once __DIR__ . '/../helpers/helpers.php';
    $this->mergeConfigFrom(__DIR__ . '/../config/slide.php', 'slide');

    AliasLoader::getInstance()->alias('SlideRender', SlideRender::class);
  }

  public function registerAdminMenu()
  {
    $eventAdminMenu = RouteMatched::class;
    $order = 5000;

    if (class_exists('Module\Cms\Events\CmsAdminMenuRegistered')) {
      $eventAdminMenu = 'Module\Cms\Events\CmsAdminMenuRegistered';
      $parent = 'content';
      $order = 20;
    }
    Event::listen($eventAdminMenu, function ($menu) use ($order) {
      $menu->add('Slide', ['route' => 'slide.admin.slide.index', 'parent' => $menu->content->id])
        ->nickname('slide')->data('order', $order)->prepend('<i class="fe-sliders"></i>');
    });
  }

  public function registerMiddlewares()
  {
    Permission::add('slide.admin.slide.index', __('slide::permission.slide.index'));
    Permission::add('slide.admin.slide.create', __('slide::permission.slide.create'));
    Permission::add('slide.admin.slide.edit', __('slide::permission.slide.edit'));
    Permission::add('slide.admin.slide.destroy', __('slide::permission.slide.destroy'));
  }
}
