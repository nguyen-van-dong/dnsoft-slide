<?php

namespace Module\Slider\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface SliderRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug($slug);

    public function createWithAuthor(array $data);
}
