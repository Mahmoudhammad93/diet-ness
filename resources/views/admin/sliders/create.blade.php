@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('sliders/store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="image">{{ trans('admin.Image') }} <span class="redStar">*</span></label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="link">{{ trans('admin.link') }} <span class="redStar">*</span></label>
                        <input type="url" name="link" class="form-control" id="link">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="status">{{ trans('admin.Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">{{ trans('admin.Select Status') }}</option>
                            <option value="1">{{ trans('admin.active') }}</option>
                            <option value="0">{{ trans('admin.DeActivate') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
