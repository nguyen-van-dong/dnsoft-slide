@extends('core::admin.master')

@section('meta_title', __('slide::slide.edit.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('slide.admin.slide.index') }}">{{ trans('slide::slide.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item active">{{ trans('slide::slide.edit.breadcrumb') }}</li>
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
<div class="row mr-0 ml-0">
  <div class="col-md-9">
    <div class="card mb-4">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="fs-17 font-weight-600 mb-0">
              {{ $slide->name }}
            </h4>
            <div>
              <code>{<span>!!</span> SlideRender::render('{{ $slide->slug }}') !!}</code>
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
            @foreach($items as $slideItem)
            <tr>
              <td style="vertical-align: middle;">{{ $slideItem->id }}</td>
              <td>
                <a href="{{ route('slide.admin.slide-item.edit', $slideItem->id) }}" style="width: 100px; display: block;">
                  <img src="{{ $slideItem->image }}" alt="{{ $slideItem->name }}" class="img-thumbnail">
                </a>
              </td>
              <td style="vertical-align: middle;">
                <a href="{{ route('slide.admin.slide-item.edit', $slideItem->id) }}">
                  {{ $slideItem->name }}
                </a>
              </td>
              <td style="vertical-align: middle;">
                @if($slideItem->is_active)
                <em class="fa fa-check text-success"></em>
                @else
                <em class="fa fa-times text-inverse"></em>
                @endif
              </td>
              <td style="vertical-align: middle;">{{ $slideItem->sort_order }}</td>
              <td style="vertical-align: middle;">{{ $slideItem->created_at }}</td>
              <td style="vertical-align: middle;">
                @translatableStatus(['editUrl' => route('slide.admin.slide-item.edit', $slideItem->id), 'item' => $slideItem])
              </td>
              <td class="text-right" style="vertical-align: middle;">
                @admincan('slide.admin.slide-item.edit')
                <a href="{{ route('slide.admin.slide-item.edit', $slideItem->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
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
  </div>
  <div class="col-md-3">
    <form action="{{ route('slide.admin.slide.update', $item->id) }}" method="POST">
      @method('PUT')
      @csrf

      <div class="card mb-4">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="fs-17 font-weight-600 mb-0">
                {{ __('slide::slide.edit.page_title') }}
              </h4>
            </div>
          </div>
        </div>
        <div class="card-body">
          @include('slide::admin.slide._fields', ['item' => $item])
        </div>
        <div class="card-footer text-right">
          <div class="btn-group">
            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@stop