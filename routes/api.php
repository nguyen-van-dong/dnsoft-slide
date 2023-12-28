<?php

use Illuminate\Support\Facades\Route;
use Module\Slide\Http\Controllers\Api\SlideController;

Route::get('slides', [SlideController::class, 'index'])->name('slide.api.slide.index');
