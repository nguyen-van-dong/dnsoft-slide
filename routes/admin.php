<?php

use Module\Slider\Http\Controllers\Admin\SliderController;
use Module\Slider\Http\Controllers\Admin\SliderItemController;

Route::prefix('slider')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('', [SliderController::class, 'index'])
            ->name('slider.admin.slider.index')
            ->middleware('admin.can:slider.admin.slider.index');

        Route::get('create', [SliderController::class, 'create'])
            ->name('slider.admin.slider.create')
            ->middleware('admin.can:slider.admin.slider.create');

        Route::post('/', [SliderController::class, 'store'])
            ->name('slider.admin.slider.store')
            ->middleware('admin.can:slider.admin.slider.create');

        Route::get('{id}/edit', [SliderController::class, 'edit'])
            ->name('slider.admin.slider.edit')
            ->middleware('admin.can:slider.admin.slider.edit');

        Route::put('{id}', [SliderController::class, 'update'])
            ->name('slider.admin.slider.update')
            ->middleware('admin.can:slider.admin.slider.edit');

        Route::delete('{id}', [SliderController::class, 'destroy'])
            ->name('slider.admin.slider.destroy')
            ->middleware('admin.can:slider.admin.slider.destroy');

        Route::get('{slider_id}/builder', [SliderItemController::class, 'index'])
            ->name('slider.admin.slider-item.index')
            ->middleware('admin.can:slider.admin.slider.edit');
    });

    Route::prefix('slider-item')->middleware('admin.can:slider.admin.slider.edit')->group(function () {
        Route::get('create', [SliderItemController::class, 'create'])
            ->name('slider.admin.slider-item.create');

        Route::post('/', [SliderItemController::class, 'store'])
            ->name('slider.admin.slider-item.store');

        Route::get('{id}/edit', [SliderItemController::class, 'edit'])
            ->name('slider.admin.slider-item.edit');

        Route::put('{id}', [SliderItemController::class, 'update'])
            ->name('slider.admin.slider-item.update');

        Route::delete('{id}', [SliderItemController::class, 'destroy'])
            ->name('slider.admin.slider-item.destroy');
    });
});
