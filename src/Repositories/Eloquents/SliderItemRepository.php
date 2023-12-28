<?php

namespace Module\Slider\Repositories\Eloquents;

use DnSoft\Core\Repositories\BaseRepository;
use Module\Slider\Repositories\SliderItemRepositoryInterface;

class SliderItemRepository extends BaseRepository implements SliderItemRepositoryInterface
{
    public function allOfSlider($sliderId, $columns = ['*'])
    {
        return $this->model
            ->where('slider_id', $sliderId)
            ->orderBy('sort_order', 'ASC')
            ->get($columns);
    }

    public function allActiveOfSlider($sliderId, $columns = ['*'])
    {
        return $this->model
            ->where('slider_id', $sliderId)
            ->where('is_active', true)
            ->orderBy('sort_order', 'ASC')
            ->get($columns);
    }

    public function getMaxSortOrderOfSlider($sliderId)
    {
        return $this->model
            ->where('slider_id', $sliderId)
            ->max('sort_order');
    }
}
