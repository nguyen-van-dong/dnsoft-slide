<?php

use Illuminate\Support\Facades\Route;
use Module\Slide\Http\Controllers\Admin\SlideController;
use Module\Slide\Http\Controllers\Admin\SlideItemController;

Route::prefix('slide')->group(function () {
  Route::prefix('')->group(function () {
    Route::get('', [SlideController::class, 'index'])
      ->name('slide.admin.slide.index')
      ->middleware('admin.can:slide.admin.slide.index');

    Route::get('create', [SlideController::class, 'create'])
      ->name('slide.admin.slide.create')
      ->middleware('admin.can:slide.admin.slide.create');

    Route::post('/', [SlideController::class, 'store'])
      ->name('slide.admin.slide.store')
      ->middleware('admin.can:slide.admin.slide.create');

    Route::get('{id}/edit', [SlideController::class, 'edit'])
      ->name('slide.admin.slide.edit')
      ->middleware('admin.can:slide.admin.slide.edit');

    Route::put('{id}', [SlideController::class, 'update'])
      ->name('slide.admin.slide.update')
      ->middleware('admin.can:slide.admin.slide.edit');

    Route::delete('{id}', [SlideController::class, 'destroy'])
      ->name('slide.admin.slide.destroy')
      ->middleware('admin.can:slide.admin.slide.destroy');

    Route::get('{slide_id}/builder', [SlideItemController::class, 'index'])
      ->name('slide.admin.slide-item.index')
      ->middleware('admin.can:slide.admin.slide.edit');
  });

  Route::prefix('slide-item')->middleware('admin.can:slide.admin.slide.edit')->group(function () {
    Route::get('create', [SlideItemController::class, 'create'])
      ->name('slide.admin.slide-item.create');

    Route::post('/', [SlideItemController::class, 'store'])
      ->name('slide.admin.slide-item.store');

    Route::get('{id}/edit', [SlideItemController::class, 'edit'])
      ->name('slide.admin.slide-item.edit');

    Route::put('{id}', [SlideItemController::class, 'update'])
      ->name('slide.admin.slide-item.update');

    Route::delete('{id}', [SlideItemController::class, 'destroy'])
      ->name('slide.admin.slide-item.destroy');
  });
});
