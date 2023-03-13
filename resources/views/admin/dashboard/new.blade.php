@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden static-top-widget-card">
                    <div class="card-body">
                        <div class="media static-top-widget">
                            <div class="media-body">
                                <h6 class="">{{ trans('admin.Sales Today') }}</h6>
                                <h5 class="mb-0 counter" style="style-weight:bold">{{ number_format($todaySales, 3) }}
                                    {{ currentCurrency() }}</h5>
                            </div>
                            <i class="fas fa-chart-line" style="font-size: 50px ; color:#f73164"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-secondary" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden static-top-widget-card">
                    <div class="card-body">
                        <div class="media static-top-widget">
                            <div class="media-body">
                                <h6 class="">{{ trans('admin.Sales Week') }}</h6>
                                <h5 class="mb-0 counter" style="style-weight:bold">{{ number_format($weekSales, 3) }}
                                    {{ currentCurrency() }}</h5>
                            </div>
                            <i class="fas fa-chart-bar" style="font-size: 50px ; color:#d64dcf"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-top-widget">
                            <div class="media-body">
                                <h6 class="">{{ trans('admin.Sales Month') }}</h6>
                                <h5 class="mb-0 counter" style="style-weight:bold">{{ number_format($monthSales, 3) }}
                                    {{ currentCurrency() }}</h5>
                            </div>
                            <i class="fas fa-chart-area" style="font-size: 50px ; color:#f73164"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-secondary" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden static-top-widget-card"
                    style="background-color: #0027b5 ;box-shadow: 0 0 15px #0027b5 ">
                    <div class="card-body">
                        <div class="media static-top-widget">
                            <div class="media-body">
                                <h6 style="color:#fff ;">{{ trans('admin.Total Sales') }}</h6>
                                <h5 style="color:#fff ;" class="mb-0 counter" style="style-weight:bold">
                                    {{ number_format($allSales, 3) }} {{ currentCurrency() }}</h5>
                            </div>
                            <i class="fas fa-chart-pie" style="font-size: 50px ; color:#d64dcf"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 box-col-3 col-lg-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="ecommerce-widgets media">
                            <div class="media-body">
                                <p class="">{{ trans('admin.Subscriptions Today') }}</p>
                                <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $todayOrders }}</span></h4>
                            </div>
                            <div class="ecommerce-box light-bg-primary"><i class="fas fa-boxes fa-lg" style="color:#d64dcf"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 box-col-3 col-lg-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="ecommerce-widgets media">
                            <div class="media-body">
                                <p class="f-w-500">{{ trans('admin.Subscriptions Week') }}</p>
                                <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $weekOrders }}</span>
                                </h4>
                            </div>
                            <div class="ecommerce-box light-bg-primary"><i class="fas fa-trophy fa-lg"
                                    style="color:#ff006f" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 box-col-3 col-lg-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="ecommerce-widgets media">
                            <div class="media-body">
                                <p class="f-w-500">{{ trans('admin.Subscriptions Month') }}</p>
                                <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $monthOrders }}</span></h4>
                            </div>
                            <div class="ecommerce-box light-bg-primary"><i class="fas fa-star fa-lg"
                                    style="color:#e5ff00" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 box-col-3 col-lg-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="ecommerce-widgets media">
                            <div class="media-body">
                                <p class="f-w-500">{{ trans('admin.All Subscriptions') }}</p>
                                <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $allOrders }}</span></h4>
                            </div>
                            <div class="ecommerce-box light-bg-primary"><i class="fas fa-copyright fa-lg"
                                    style="color:#c300ff" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <!-- chartjs js -->
        <script src="{{ asset('dashboard') }}/assets/js/plugins/Chart.min.js"></script>
        <!-- highchart chart -->
        <script src="{{ asset('dashboard') }}/assets/js/plugins/highcharts.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/plugins/highcharts-3d.js"></script>
    @endpush
@endsection
