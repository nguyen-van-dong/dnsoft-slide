<?php

namespace Module\Slide\Models;

use DnSoft\Core\Traits\CacheableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Slide extends Model
{
    // use LogsActivity;

    protected static $logName = 'Slide_Slide';

    protected $table = 'slide__slides';

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

    public function slideItems()
    {
        return $this->hasMany(SlideItem::class);
    }

    public function getLayoutAttribute($value)
    {
        return $value ?: config('slide.default');
    }

}
