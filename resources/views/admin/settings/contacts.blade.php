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
                            <label class="floating-label" for="contacts_ar">{{ trans('admin.Contacts Ar') }}</label>
                            <textarea name="contacts_ar" id="contacts_ar" class="form-control">{{ $setting->contacts_ar }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="floating-label" for="contacts_en">{{ trans('admin.Contacts En') }}</label>
                            <textarea name="contacts_en" id="contacts_en" class="form-control">{{ $setting->contacts_en }}</textarea>
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
                CKEDITOR.replace('contacts_ar', {
                    height: 450
                });
                CKEDITOR.replace('contacts_en', {
                    height: 450
                });
            });
        </script>
    @endpush
@endsection
