<?php

namespace Module\Slide\Models;

use DnSoft\Core\Traits\CacheableTrait;
use DnSoft\Core\Traits\TranslatableTrait;
use DnSoft\Media\Traits\HasMediaTraitV3;
use Illuminate\Database\Eloquent\Model;

class SlideItem extends Model
{
  use HasMediaTraitV3;
  use CacheableTrait;
  use TranslatableTrait;

  protected static $logName = 'Slide_Slide-item';

  protected $table = 'slide__slide_items';

  protected $fillable = [
    'slide_id',
    'name',
    'description',
    'content',
    'attributes',
    'is_active',
    'sort_order',
    'image',
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

  public function slide()
  {
    return $this->belongsTo(Slide::class);
  }

  public function setImageAttribute($value)
  {
    $this->mediaAttributes['image'] = $value;
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
    return 'image';
  }
}
