@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>{{ trans('admin.Name') }}</td>
                                    <td>{{ $package->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.Description') }}</td>
                                    <td>{{ $package->description }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.Plans') }}</td>
                                    <td>{{ $package->plans_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('admin.Plans') }}
                    <a href="{{ aurl('packages/plans/create/' . $package->id) }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Plan') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Details') }}</th>
                                    <th>{{ trans('admin.Price') }}</th>
                                    <th>{{ trans('admin.Duration') }}</th>
                                    <th>{{ trans('admin.Is Default') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->id }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->details }}</td>
                                        <td>
                                            {{ $plan->new_price }} {{ trans('admin.KWD') }}
                                            @if ($plan->old_price)
                                                <br>
                                                <del>{{ $plan->old_price }} {{ trans('admin.KWD') }} </del>
                                            @endif
                                        </td>
                                        <td>{{ $plan->duration }} {{ trans('admin.Day') }}</td>
                                        <td>
                                            @if ($plan->is_default)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ aurl('packages/plans/view/' . $plan->id) }}"
                                                class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                                    class="fas fa-eye"></i>
                                                {{ trans('admin.View') }}</a>

                                            <a href="{{ aurl('packages/plans/edit/' . $plan->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>

                                            <button data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                {{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true"
        id="deleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Delete') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('packages/plans/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="planName"></p>
                        </div>
                        <input type="hidden" id="plan_id" name="plan_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>
                        <button type="submit"
                            class="btn btn-pill btn-outline-danger btn-air-danger">{{ trans('admin.Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#delete ").click(function() {
                    var planName = $(this).attr('data-name');
                    var planId = $(this).attr('data-id');
                    $("#planName").text(planName);
                    $("#plan_id").val(planId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
