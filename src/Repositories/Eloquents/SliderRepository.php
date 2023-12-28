<?php

namespace Module\Slider\Repositories\Eloquents;

use DnSoft\Core\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Module\Slider\Repositories\SliderRepositoryInterface;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{
    public function findBySlug($slug)
    {
        return $this->model
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function createWithAuthor(array $data)
    {
        $model = $this->model->fill($data);

        $model->author()->associate(Auth::guard('admin')->user());

        $model->save();

        return $model;
    }

}
