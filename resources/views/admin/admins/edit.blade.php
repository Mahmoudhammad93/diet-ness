@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush

    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('admins/update/'.$admin->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="name">{{ trans('admin.Name') }} <span class="redStar">*</span></label>
                        <input type="text" name="name" value="{{ $admin->name }}" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="email">{{ trans('admin.Email') }} <span class="redStar">*</span></label>
                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="mobile">{{ trans('admin.Mobile') }} <span class="redStar">*</span></label>
                        <input type="number" name="mobile" value="{{ $admin->mobile }}" class="form-control" id="mobile">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="password">{{ trans('admin.Password') }}</label>
                        <input type="password" name="password" class="form-control" id="password">
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
