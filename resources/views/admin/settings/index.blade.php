@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <form action="{{ aurl('settings/update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <h5 class="card-header">{{ $title }}</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="floating-label" for="name_ar">{{ trans('admin.Name Ar') }}</label>
                            <input type="text" value="{{ $setting->name_ar }}" name="name_ar" class="form-control" id="name_ar">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="name_en">{{ trans('admin.Name En') }}</label>
                            <input type="text" value="{{ $setting->name_en }}" name="name_en" class="form-control" id="name_en">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="address_ar">{{ trans('admin.Address Ar') }}</label>
                            <input type="text" value="{{ $setting->address_ar }}" name="address_ar" class="form-control" id="address_ar">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="address_en">{{ trans('admin.Address En') }}</label>
                            <input type="text" value="{{ $setting->address_en }}" name="address_en" class="form-control" id="address_en">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="email">{{ trans('admin.Email') }}</label>
                            <input type="text" value="{{ $setting->email }}" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="phone">{{ trans('admin.Phone') }}</label>
                            <input type="text" value="{{ $setting->phone }}" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="whatsapp">{{ trans('admin.Whatsapp') }}</label>
                            <input type="text" value="{{ $setting->whatsapp }}" name="whatsapp" class="form-control" id="whatsapp">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="facebook">{{ trans('admin.Facebook') }}</label>
                            <input type="text" value="{{ $setting->facebook }}" name="facebook" class="form-control" id="facebook">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="instagram">{{ trans('admin.Instagram') }}</label>
                            <input type="text" value="{{ $setting->instagram }}" name="instagram" class="form-control" id="instagram">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="twitter">{{ trans('admin.Twitter') }}</label>
                            <input type="text" value="{{ $setting->twitter }}" name="twitter" class="form-control" id="twitter">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="snapchat">{{ trans('admin.Snapchat') }}</label>
                            <input type="text" value="{{ $setting->snapchat }}" name="snapchat" class="form-control" id="snapchat">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="appstore">{{ trans('admin.App Store') }}</label>
                            <input type="text" value="{{ $setting->appstore }}" name="appstore" class="form-control" id="appstore">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="playstore">{{ trans('admin.Play Store') }}</label>
                            <input type="text" value="{{ $setting->playstore }}" name="playstore" class="form-control" id="playstore">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <input type="file" name="logo" id="coverInput"
                                class="custom-file-container__custom-file__custom-file-input" accept="image/*"
                                style="display: none">
                            <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary pull-right" id="selectCover"><i
                                    class="fas fa-image"></i>
                                {{ trans('admin.Upload Logo') }}</button>
                            <div class="coverImgPreview">
                                <img src="{{ $setting->logo }}"
                                    style="max-height: 100%" id="targetImage" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('script')
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2.full.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2-custom.js"></script>

        <script>
            $(function() {
                $("#selectCover").click(function() {
                    $("#coverInput").click();
                });

                // Multiple images preview in browser
                var coverImagesPreview = function(input, placeToInsertImagePreview) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).addClass("img-thumbnail").appendTo(
                                    placeToInsertImagePreview);
                            }
                            reader.readAsDataURL(input.files[i]);

                        }
                    }
                };

                $('#coverInput').on('change', function() {
                    $("div.coverImgPreview").empty();
                    coverImagesPreview(this, 'div.coverImgPreview');
                });
            });
        </script>
    @endpush
@endsection
