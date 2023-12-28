<?php

namespace Module\Slider\Models;

use DnSoft\Core\Traits\CacheableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    // use LogsActivity;

    protected static $logName = 'slider_slider';

    protected $table = 'slider__sliders';

    use CacheableTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'layout',
        'options',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function author()
    {
        return $this->morphTo();
    }

    public function sliderItems()
    {
        return $this->hasMany(SliderItem::class);
    }

    public function getLayoutAttribute($value)
    {
        return $value ?: config('slider.default');
    }

}
