@extends('admin.layouts.app')
@section('content')
    @push('styles')
        
    @endpush
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Customer') }}</h5>
                </div>
                <div class="card-body">
                    <div class="customerProfile text-center">
                        <img src="{{ asset('dashboard/assets/images/avatar.png') }}" class="rounded-circle align-top"
                            style="max-width: 50%" alt="">
                    </div>
                    <hr>
                    <div class="information">
                        <h6><span style="display: inline-block ; width: 20px;text-align: center;margin-bottom: 10px"><i
                                    class="fas fa-user"></i> </span>{{ $user->name }}</h6>
                        <h6><span style="display: inline-block ; width: 20px;text-align: center;margin-bottom: 10px"><i
                                    class="fas fa-mobile-alt"></i></span> {{ $user->mobile }}</h6>
                        <h6><span style="display: inline-block ; width: 20px;text-align: center;margin-bottom: 10px"><i
                                    class="far fa-envelope"></i></span> {{ $user->email }}</h6>
                        <hr>
                        <h6><span style="display: inline-block ; width: 20px;text-align: center;margin-bottom: 10px"><i
                                    class="far fa-clock"></i></span> {{ $user->created_at }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Addresses') }}</h5>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <th>{{ trans('admin.City') }}</th>
                                    <th>{{ trans('admin.Street') }}</th>
                                    <th>{{ trans('admin.Floor') }}</th>
                                    <th>{{ trans('admin.Apartment No') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($user->addresses as $address)
                                        <tr>
                                            <td>{{ $address->area->city->name }} - {{ $address->area->name }}</td>
                                            <td>{{ $address->street }}</td>
                                            <td>{{ $address->floor }}</td>
                                            <td>{{ $address->apartment_no }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Subscriptions') }}</h5>
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

    </div>

@endsection
