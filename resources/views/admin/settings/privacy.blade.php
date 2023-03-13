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
                            <label class="floating-label" for="privacy_ar">{{ trans('admin.Privacy And Policy Ar') }}</label>
                            <textarea name="privacy_ar" id="privacy_ar" class="form-control">{{ $setting->privacy_ar }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="floating-label" for="privacy_en">{{ trans('admin.Privacy And Policy En') }}</label>
                            <textarea name="privacy_en" id="privacy_en" class="form-control">{{ $setting->privacy_en }}</textarea>
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
                CKEDITOR.replace('privacy_ar', {
                    height: 450
                });
                CKEDITOR.replace('privacy_en', {
                    height: 450
                });
            });
        </script>
    @endpush
@endsection
