<?php

namespace Module\Slide\Repositories\Eloquents;

use DnSoft\Core\Repositories\BaseRepository;
use Module\Slide\Repositories\SlideItemRepositoryInterface;

class SlideItemRepository extends BaseRepository implements SlideItemRepositoryInterface
{
    public function allOfSlide($slideId, $columns = ['*'])
    {
        return $this->model
            ->where('Slide_id', $slideId)
            ->orderBy('sort_order', 'ASC')
            ->get($columns);
    }

    public function allActiveOfSlide($slideId, $columns = ['*'])
    {
        return $this->model
            ->where('Slide_id', $slideId)
            ->where('is_active', true)
            ->orderBy('sort_order', 'ASC')
            ->get($columns);
    }

    public function getMaxSortOrderOfSlide($slideId)
    {
        return $this->model
            ->where('Slide_id', $slideId)
            ->max('sort_order');
    }
}
