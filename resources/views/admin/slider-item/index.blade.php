@extends('core::admin.master')

@section('meta_title', __('slider::slider-item.index.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('slider.admin.slider.index') }}">{{ trans('slider::slider.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item active">{{ $slider->name }}</li>
        </ol>
      </div>
      <h4 class="page-title">
        {{ __('slider::slider.index.page_title') }}
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="card mb-4">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="fs-17 font-weight-600 mb-0">
          {{ $slider->name }}
        </h4>
        <div>
          <code>{<span>!!</span> SliderRender::render('{{ $slider->slug }}') !!}</code>
        </div>
      </div>
      <div class="text-right">
        <div class="actions">
          @admincan('slider.admin.slider.create')
          <a href="{{ route('slider.admin.slider-item.create', ['slider_id' => $slider->id]) }}" class="btn btn-success">
            <em class="fa fa-plus"></em>
            {{ __('Add Slide Item') }}
          </a>
          @endadmincan
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered dt-responsive nowrap bootstrap4-styling">
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('slider::slider-item.image') }}</th>
          <th>{{ __('slider::slider-item.name') }}</th>
          <th>{{ __('slider::slider-item.is_active') }}</th>
          <th>{{ __('slider::slider-item.sort_order') }}</th>
          <th>{{ __('slider::slider-item.created_at') }}</th>
          <th>@translatableHeader</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
          <td style="vertical-align: middle;">{{ $item->id }}</td>
          <td>
            <a href="{{ route('slider.admin.slider-item.edit', $item->id) }}">
              <img src="{{ $item->image }}" alt="{{ $item->name}}" width="100px"/>
            </a>
          </td>
          <td style="vertical-align: middle;">
            <a href="{{ route('slider.admin.slider-item.edit', $item->id) }}">
              {{ $item->name }}
            </a>
          </td>
          <td style="vertical-align: middle;">
            @if($item->is_active)
            <em class="fa fa-check text-success"></em>
            @else
            <em class="fa fa-times text-inverse"></em>
            @endif
          </td>
          <td style="vertical-align: middle;">{{ $item->sort_order }}</td>
          <td style="vertical-align: middle;">{{ $item->created_at }}</td>
          <td style="vertical-align: middle;">
            @translatableStatus(['editUrl' => route('slider.admin.slider-item.edit', $item->id)])
          </td>
          <td class="text-right" style="vertical-align: middle;">
            @admincan('slider.admin.slider-item.edit')
            <a href="{{ route('slider.admin.slider-item.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
              <em class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></em>
            </a>
            @endadmincan

            @admincan('slider.admin.slider-item.destroy')
            <x-button-delete-v1 url="{{ route('slider.admin.slider-item.destroy', $item->id) }}"/>
            @endadmincan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
@stop
