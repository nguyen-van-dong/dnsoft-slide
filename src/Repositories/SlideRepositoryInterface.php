<?php

namespace Module\Slide\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface SlideRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug($slug);

    public function createWithAuthor(array $data);
}
