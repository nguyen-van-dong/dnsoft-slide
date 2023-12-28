<?php

namespace Module\Slide\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface SlideItemRepositoryInterface extends BaseRepositoryInterface
{
    public function allOfSlide($slideId, $columns = ['*']);

    public function allActiveOfSlide($slideId, $columns = ['*']);

    public function getMaxSortOrderOfSlide($slideId);

}
