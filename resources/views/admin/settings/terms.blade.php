@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <form action="{{ aurl('settings/update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <h5 class="card-header">{{ $title }}</h5>
                    <div class="card-body">

                        <div class="form-group">
                            <label class="floating-label"
                                for="terms_ar">{{ trans('admin.Terms And Conditions Ar') }}</label>
                            <textarea name="terms_ar" id="terms_ar" class="form-control">{{ $setting->terms_ar }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="floating-label"
                                for="terms_en">{{ trans('admin.Terms And Conditions En') }}</label>
                            <textarea name="terms_en" id="terms_en" class="form-control">{{ $setting->terms_en }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('script')
    <script src="https://cdn.ckeditor.com/4.20.0/full-all/ckeditor.js"></script>

    <script>

        $(document).ready(function() {
            CKEDITOR.replace('terms_ar', {
                height: 450
            });
            CKEDITOR.replace('terms_en', {
                height: 450
            });
        });
    </script>
    @endpush
@endsection
