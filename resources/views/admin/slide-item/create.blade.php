@extends('core::admin.master')

@section('meta_title', __('slide::slide-item.create.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('slide.admin.slide.index') }}">{{ trans('slide::slide.index.breadcrumb') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('slide.admin.slide-item.index', $slide->id) }}">{{ $slide->name }}</a></li>
          <li class="breadcrumb-item active">{{ trans('slide::slide-item.create.breadcrumb') }}</li>
        </ol>
      </div>
      <h4 class="page-title">
        {{ __('slide::slide.create.page_title') }}
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<form action="{{ route('slide.admin.slide-item.store') }}" method="POST">
  @csrf

  <input type="hidden" name="slide_id" value="{{ $slide->id }}">

  <div class="card mb-4">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5 class="fs-17 font-weight-600 mb-0">
            {{ __('slide::slide-item.create.page_title') }}
          </h5>
          @translatableAlert
        </div>
        <div class="text-right">
          <div class="btn-group">
            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      @include('slide::admin.slide-item._fields', ['item' => $item])
    </div>
    <div class="card-footer text-right">
      <div class="btn-group">
        <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
        <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
      </div>
    </div>
  </div>
</form>
@stop