@extends('core::admin.master')

@section('meta_title', __('slide::slide.index.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item active">{{ trans('slide::slide.index.breadcrumb') }}</li>
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
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <div class="mb-2">
        <div class="row">
          <div class="col-12 text-sm-center form-inline">
            <div class="form-group mr-2">
              <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('slide.admin.slide.create') }}"><em class="mdi mdi-plus-circle mr-2"></em> Add New Slide</a>
            </div>
            <form action="">
              <div class="form-group">
                <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                <input type="submit" value="Search" class="btn btn-secondary ml-5">
              </div>
            </form>

          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
          <thead>
            <tr>
              <th>{{ __('ID') }}</th>
              <th>{{ __('slide::slide.name') }}</th>
              <th>{{ __('slide::slide.slug') }}</th>
              <th>{{ __('slide::slide.layout') }}</th>
              <th>{{ __('slide::slide.is_active') }}</th>
              <th>{{ __('slide::slide.created_at') }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>
                <a href="{{ route('slide.admin.slide.edit', $item->id) }}">
                  {{ $item->name }}
                </a>
              </td>
              <td>
                <code>{<span>!!</span> \SlideRender::render('{{ $item->slug }}') !!}</code>
              </td>
              <td>{{ get_slide_layout_label($item->layout) }}</td>
              <td>
                @if($item->is_active)
                <i class="fa fa-check text-success"></i>
                @else
                <i class="fa fa-times text-inverse"></i>
                @endif
              </td>
              <td>{{ $item->created_at }}</td>

              <td class="text-right">
                @admincan('slide.admin.slide.edit')
                <a href="{{ route('slide.admin.slide-item.index', $item->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid" title="{{ trans('slide::slide-item.builder') }}">
                  <i class="fas fa-drafting-compass" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('slide.admin.slide.edit')
                <a href="{{ route('slide.admin.slide.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                  <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('slide.admin.slide.destroy')
                <x-button-delete-v1 url="{{ route('slide.admin.slide.destroy', $item->id) }}"/>
                @endadmincan
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <div class="float-right">
          {{ $items->links() }}
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop