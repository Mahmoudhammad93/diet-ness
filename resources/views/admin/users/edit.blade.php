@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('users/update/'.$user->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="first_name">{{ trans('admin.First Name') }} <span class="redStar">*</span></label>
                        <input type="text" name="first_name" value="{{ $user->details->first_name }}" class="form-control" id="first_name">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="last_name">{{ trans('admin.Last Name') }} <span class="redStar">*</span></label>
                        <input type="text" name="last_name" value="{{ $user->details->last_name }}" class="form-control" id="last_name">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="email">{{ trans('admin.Email') }} <span class="redStar">*</span></label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="mobile">{{ trans('admin.Mobile') }} <span class="redStar">*</span></label>
                        <input type="number" name="mobile" value="{{ $user->mobile }}" class="form-control" id="mobile">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="password">{{ trans('admin.Password') }}</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="gender">{{ trans('admin.Gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option {{ $user->details->gender == "male"?"selected":"" }} value="male">{{ trans('admin.Male') }}</option>
                            <option {{ $user->details->gender == "female"?"selected":"" }} value="female">{{ trans('admin.Female') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="birth_date">{{ trans('admin.Birthdate') }} <span class="redStar">*</span></label>
                        <input type="text" name="birth_date" value="{{ $user->details->birth_date }}" class="form-control" id="birth_date">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2.full.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/select2/select2-custom.js"></script>
    @endpush
@endsection
