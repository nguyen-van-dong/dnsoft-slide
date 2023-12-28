<?php

namespace Module\Slider\Models;

use DnSoft\Core\Traits\CacheableTrait;
use DnSoft\Core\Traits\TranslatableTrait;
use DnSoft\Media\Traits\HasMediaTraitV3;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
  use HasMediaTraitV3;
  use CacheableTrait;
  use TranslatableTrait;
  // use LogsActivity;

  protected static $logName = 'slider_slider-item';

  protected $table = 'slider__slider_items';

  protected $fillable = [
    'slider_id',
    'name',
    'description',
    'content',
    'attributes',
    'is_active',
    'sort_order',
    'gallery',
    'link',
  ];

  public $translatable = [
    'name',
    'description',
    'content',
    'link',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function slider()
  {
    return $this->belongsTo(Slider::class);
  }

  public function setGalleryAttribute($value)
  {
    $this->mediaAttributes['gallery'] = $value;
  }

  public function getGalleryAttribute()
  {
    return $this->getGallery($this->getMediaConversion());
  }

  public function getImageAttribute()
  {
    return $this->getFirstMedia($this->getMediaConversion());
  }

  /**
   * Get media group
   * @return string
   */
  public function getMediaConversion(): string
  {
    return 'gallery';
  }
}
