@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('categories/store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="ar_name">{{ trans('admin.Name Ar') }} <span class="redStar">*</span></label>
                        <input type="text" name="ar_name" class="form-control" id="ar_name">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="en_name">{{ trans('admin.Name En') }} <span class="redStar">*</span></label>
                        <input type="text" name="en_name" class="form-control" id="en_name">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
