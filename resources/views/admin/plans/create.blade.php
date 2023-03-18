@extends('admin.layouts.app')
@section('content')
    <form action="{{ aurl('packages/plans/create/' . $package->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="name_ar">{{ trans('admin.Name Ar') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control"
                            id="name_ar">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="name_en">{{ trans('admin.Name En') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control"
                            id="name_en">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="duration">{{ trans('admin.Duration By Days') }} <span
                                class="redStar">*</span></label>
                        <input type="text" value="{{ old('duration') }}" name="duration" class="form-control"
                            id="duration">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="floating-label" for="old_price">{{ trans('admin.Old Price') }} <span
                                    class="redStar">*</span></label>
                            <input type="number" value="{{ old('old_price') }}" name="old_price" class="form-control"
                                id="old_price">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="floating-label" for="new_price">{{ trans('admin.New Price') }} <span
                                    class="redStar">*</span></label>
                            <input type="number" value="{{ old('new_price') }}" name="new_price" class="form-control"
                                id="new_price">
                        </div>
                    </div>

                    <div class="media mb-2">
                        <div class="media-body text-end switch-outline" style="flex: 0 !important">
                            <label for="is_default" class="switch">
                                <input name="is_default" type="checkbox" id="is_default">
                                <span class="switch-state bg-primary"></span>
                            </label>
                        </div>
                        <label style="margin-top: 9px;" for="is_default"
                            class="m-r-10">{{ trans('admin.Is Default') }}</label>
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="details_ar">{{ trans('admin.Details Ar') }} <span
                                class="redStar">*</span></label>
                        <textarea name="details_ar" rows="4" class="form-control" id="details_ar">{{ old('details_ar') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="details_en">{{ trans('admin.Details En') }} <span
                                class="redStar">*</span></label>
                        <textarea name="details_en" rows="4" class="form-control" id="details_en">{{ old('details_en') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ trans('admin.Meals') }}</h5>
                <div class="card-body">
                    <div id="mealsArea">
                        <div class="row">
                            <div class="col-md-11">

                                {{-- <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="meal_name_ar">{{ trans('admin.Name Ar') }} <span
                                                class="redStar">*</span></label>
                                        <input type="text" name="meal_name_ar[]" class="form-control" id="meal_name_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="meal_name_en">{{ trans('admin.Name En') }}
                                            <span class="redStar">*</span></label>
                                        <input type="text" name="meal_name_en[]" class="form-control"
                                            id="meal_name_en">
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="floating-label" for="image">{{ trans('admin.Image') }} <span class="redStar">*</span></label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="floating-label" for="meal_details_ar">{{ trans('admin.Categories') }}
                                            <span class="redStar">*</span></label>

                                        <select name="category[]" id="category" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="floating-label" for="meal_details_ar">{{ trans('admin.Meals') }}
                                            <span class="redStar">*</span></label>

                                        <select name="meal[]" id="category" class="form-control">
                                            @foreach ($meals as $meal)
                                                <option value="{{$meal->id}}">{{$meal->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="floating-label" for="meal_details_ar">{{ trans('admin.Components') }}
                                            <span class="redStar">*</span></label>

                                        <select name="components[]" id="category" class="form-control" multiple>
                                            @foreach ($components as $component)
                                                <option value="{{$component->id}}">{{$component->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="meal_name_ar">{{ trans('admin.Name Ar') }}
                                            <span class="redStar">*</span></label>
                                        <input type="text" name="meal_name_ar[]" class="form-control"
                                            id="meal_name_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="meal_name_en">{{ trans('admin.Name En') }}
                                            <span class="redStar">*</span></label>
                                        <input type="text" name="meal_name_en[]" class="form-control"
                                            id="meal_name_en">
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="floating-label"
                                            for="meal_details_ar">{{ trans('admin.Details Ar') }}
                                            <span class="redStar">*</span></label>
                                        <input type="text" name="meal_details_ar[]" class="form-control"
                                            id="meal_details_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="floating-label"
                                            for="meal_details_en">{{ trans('admin.Details En') }}
                                            <span class="redStar">*</span></label>
                                        <input type="text" name="meal_details_en[]" class="form-control"
                                            id="meal_details_en">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="meal_price">{{ trans('admin.Price') }} <span
                                                class="redStar">*</span></label>
                                        <input type="number" name="meal_price[]" class="form-control" id="meal_price">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="quantity">{{ trans('admin.Quantity') }} <span
                                                class="redStar">*</span></label>
                                        <input type="number" name="quantity[]" class="form-control" id="quantity">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="max">{{ trans('admin.Max') }} <span
                                                class="redStar">*</span></label>
                                        <input type="number" name="max[]" class="form-control" id="max">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="floating-label" for="min">{{ trans('admin.Min') }} <span
                                                class="redStar">*</span></label>
                                        <input type="number" name="min[]" class="form-control" id="min">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger" id="delete"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div id="moreMeals"></div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                    class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                        </div>
                        <div class="col-md-3" style="text-align: end">
                            <button id="addMoteMeal" type="button" class="btn btn-pill btn-outline-info btn-air-info"><i
                                    class="fas fa-plus"></i>&nbsp;{{ trans('admin.Add New Meal') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('script')
        <script>
            $(document).ready(function() {
                var mealArea = $("#mealsArea").html();
                $("#addMoteMeal").click(function() {
                    $("#moreMeals").append(mealArea);
                    $("#delete ").click(function() {
                        $(this).parent().parent().remove()
                    });
                });
            });
        </script>
    @endpush
@endsection
