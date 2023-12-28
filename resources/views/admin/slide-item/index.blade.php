@extends('core::admin.master')

@section('meta_title', __('slide::slide-item.index.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('slide.admin.slide.index') }}">{{ trans('slide::slide.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item active">{{ $slide->name }}</li>
        </ol>
      </div>
      <h4 class="page-title">
        {{ __('slide::slide.index.page_title') }}
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
          {{ $slide->name }}
        </h4>
        <div>
          <code>{<span>!!</span> SliderRender::render('{{ $slide->slug }}') !!}</code>
        </div>
      </div>
      <div class="text-right">
        <div class="actions">
          @admincan('slide.admin.slide.create')
          <a href="{{ route('slide.admin.slide-item.create', ['slide_id' => $slide->id]) }}" class="btn btn-success">
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
          <th>{{ __('slide::slide-item.image') }}</th>
          <th>{{ __('slide::slide-item.name') }}</th>
          <th>{{ __('slide::slide-item.is_active') }}</th>
          <th>{{ __('slide::slide-item.sort_order') }}</th>
          <th>{{ __('slide::slide-item.created_at') }}</th>
          <th>@translatableHeader</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
          <td style="vertical-align: middle;">{{ $item->id }}</td>
          <td>
            <a href="{{ route('slide.admin.slide-item.edit', $item->id) }}">
              <img src="{{ $item->image }}" alt="{{ $item->name}}" width="100px"/>
            </a>
          </td>
          <td style="vertical-align: middle;">
            <a href="{{ route('slide.admin.slide-item.edit', $item->id) }}">
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
            @translatableStatus(['editUrl' => route('slide.admin.slide-item.edit', $item->id)])
          </td>
          <td class="text-right" style="vertical-align: middle;">
            @admincan('slide.admin.slide-item.edit')
            <a href="{{ route('slide.admin.slide-item.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
              <em class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></em>
            </a>
            @endadmincan

            @admincan('slide.admin.slide-item.destroy')
            <x-button-delete-v1 url="{{ route('slide.admin.slide-item.destroy', $item->id) }}"/>
            @endadmincan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
@stop