<?php

namespace Module\Slider\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface SliderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function allOfSlider($sliderId, $columns = ['*']);

    public function allActiveOfSlider($sliderId, $columns = ['*']);

    public function getMaxSortOrderOfSlider($sliderId);

}
