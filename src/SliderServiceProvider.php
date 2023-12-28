<?php

namespace Module\Slider;

use DnSoft\Acl\Facades\Permission;
use DnSoft\Core\Support\BaseModuleServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Module\Slider\Facades\SliderRender;
use Module\Slider\Models\Slider;
use Module\Slider\Models\SliderItem;
use Module\Slider\Repositories\Eloquents\SliderItemRepository;
use Module\Slider\Repositories\Eloquents\SliderRepository;
use Module\Slider\Repositories\SliderItemRepositoryInterface;
use Module\Slider\Repositories\SliderRepositoryInterface;
use Module\Slider\Services\SliderRenderService;

class SliderServiceProvider extends BaseModuleServiceProvider
{
  public function getModuleNamespace(): string
  {
    return 'slider';
  }

  public function register()
  {
    parent::register();

    $this->app->singleton(SliderItemRepositoryInterface::class, function () {
      return new SliderItemRepository(new SliderItem());
    });

    $this->app->singleton(SliderRepositoryInterface::class, function () {
      return new SliderRepository(new Slider());
    });

    $this->app->singleton('slider.render', SliderRenderService::class);
  }

  public function boot()
  {
    parent::boot();
    $this->registerAdminMenu();
    $this->registerMiddlewares();
    require_once __DIR__ . '/../helpers/helpers.php';
    $this->mergeConfigFrom(__DIR__ . '/../config/slider.php', 'slider');

    AliasLoader::getInstance()->alias('SliderRender', SliderRender::class);
  }

  public function registerAdminMenu()
  {
    $eventAdminMenu = RouteMatched::class;
    $parent = null;
    $order = 5000;

    if (class_exists('Module\Cms\Events\CmsAdminMenuRegistered')) {
      $eventAdminMenu = 'Module\Cms\Events\CmsAdminMenuRegistered';
      $parent = 'content';
      $order = 20;
    }
    Event::listen($eventAdminMenu, function ($menu) use ($order) {
      $menu->add('Slider', ['route' => 'slider.admin.slider.index', 'parent' => $menu->content->id])
        ->nickname('slider')->data('order', $order)->prepend('<i class="fas fa-sliders-h"></i>');
    });
  }

  public function registerMiddlewares()
  {
    Permission::add('slider.admin.slider.index', __('slider::permission.slider.index'));
    Permission::add('slider.admin.slider.create', __('slider::permission.slider.create'));
    Permission::add('slider.admin.slider.edit', __('slider::permission.slider.edit'));
    Permission::add('slider.admin.slider.destroy', __('slider::permission.slider.destroy'));
  }
}
