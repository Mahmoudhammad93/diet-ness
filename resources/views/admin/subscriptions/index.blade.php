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
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('admin.User') }}</th>
                                    <th>{{ trans('admin.Plan') }}</th>
                                    <th>{{ trans('admin.Start Date') }}</th>
                                    <th>{{ trans('admin.End Date') }}</th>
                                    <th>{{ trans('admin.Total') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->id }}</td>
                                        <td>{{ $subscription->user->details->name }}</td>
                                        <td>{{ $subscription->plan->name }}</td>
                                        <td>
                                            <span class="badge badge-{{ $subscription->status }}">{{ trans('admin.' . $subscription->status) }}</span>
                                            <br>
                                            {{ $subscription->start_at }} -
                                            {{ \Carbon\Carbon::parse($subscription->start_at)->diffForHumans() }}
                                        </td>
                                        <td>
                                            {{ $subscription->end_at }}
                                            <br>
                                            {{ \Carbon\Carbon::parse($subscription->end_at)->diffForHumans() }}
                                        </td>
                                        <td>{{ number_format($subscription->total, 3) }} {{ trans('admin.KWD') }}</td>
                                        <td>
                                            <a href="{{ aurl('subscriptions/view/' . $subscription->id) }}"
                                                class="btn btn-pill btn-outline-info"><i class="fas fa-eye"></i>
                                                {{ trans('admin.View') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subscriptions->links('admin.pagination.index') }}
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
                <form action="{{ aurl('subscriptions/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="subscriptionName"></p>
                        </div>
                        <input type="hidden" id="subscription_id" name="subscription_id" value="">
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
                    var subscriptionName = $(this).attr('data-name');
                    var subscriptionId = $(this).attr('data-id');
                    $("#subscriptionName").text(subscriptionName);
                    $("#subscription_id").val(subscriptionId);
                    $("#deleteModal").modal('show');
                });
            });
        </script>
    @endpush
@endsection
