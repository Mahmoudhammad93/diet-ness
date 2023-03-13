@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('packages/create') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="name_ar">{{ trans('admin.Name Ar') }} <span class="redStar">*</span></label>
                        <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control" id="name_ar">
                    </div>
                    
                    <div class="form-group">
                        <label class="floating-label" for="name_en">{{ trans('admin.Name En') }} <span class="redStar">*</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control" id="name_en">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="description_ar">{{ trans('admin.Description Ar') }} <span class="redStar">*</span></label>
                        <textarea name="description_ar" rows="6" class="form-control" id="description_ar">{{ old('description_ar') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="floating-label" for="description_en">{{ trans('admin.Description En') }} <span class="redStar">*</span></label>
                        <textarea name="description_en" rows="6" class="form-control" id="description_en">{{ old('description_en') }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
