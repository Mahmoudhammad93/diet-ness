@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('goals/categories/update/'.$category->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="image" style="width: 150px;height: 150px">
                        <img src="{{$category->image}}" alt="" style="width: 100%;height: 100%">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="image">{{ trans('admin.Image') }} <span class="redStar">*</span></label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="ar_name">{{ trans('admin.Name Ar') }} <span class="redStar">*</span></label>
                        <input type="text" name="ar_name" class="form-control" id="ar_name" value="{{$category->ar_name}}">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="en_name">{{ trans('admin.Name En') }} <span class="redStar">*</span></label>
                        <input type="text" name="en_name" class="form-control" id="en_name" value="{{$category->en_name}}">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="status">{{ trans('admin.Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">{{ trans('admin.Select Status') }}</option>
                            <option value="1" {{($category->status == 1)?'selected':''}}>{{ trans('admin.active') }}</option>
                            <option value="0" {{($category->status == 0)?'selected':''}}>{{ trans('admin.DeActivate') }}</option>
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
