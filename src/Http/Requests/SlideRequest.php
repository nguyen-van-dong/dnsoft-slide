<?php

namespace Module\Slide\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:Slide__Slides,slug,'.$this->route('id'),
        ];
    }

    public function attributes()
    {
        return [
            'name'  => __('Slide::Slide.name'),
            'slug'  => __('Slide::Slide.slug'),
        ];
    }
}
