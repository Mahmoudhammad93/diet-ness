@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('packages/update/' . $package->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="name_ar">{{ trans('admin.Name Ar') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name_ar" value="{{ $package->name_ar }}" class="form-control"
                            id="name_ar">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="name_en">{{ trans('admin.Name En') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name_en" value="{{ $package->name_en }}" class="form-control"
                            id="name_en">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="description_ar">{{ trans('admin.Description Ar') }} <span
                                class="redStar">*</span></label>
                        <textarea name="description_ar" class="form-control" id="description_ar">{{ $package->description_ar }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="description_en">{{ trans('admin.Description En') }} <span
                                class="redStar">*</span></label>
                        <textarea name="description_en" class="form-control" id="description_en">{{ $package->description_en }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                            class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2.full.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2-custom.js"></script>
    @endpush
@endsection
