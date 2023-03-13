@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <style>
            .page {
                display: none;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Subscription Details') }}
                        <button type="button" id="printBtn" onclick="printpage();"
                            class="btn btn-pill btn-outline-info btn-air-info btn-sm pull-right"><i
                                class="fas fa-print"></i></button>
                    </h5>
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
                                        <th>{{ trans('admin.Duration By Days') }}</th>
                                        <th>{{ trans('admin.Start Date') }}</th>
                                        <th>{{ trans('admin.End Date') }}</th>
                                        <th>{{ trans('admin.Status') }}</th>
                                        <th>{{ trans('admin.Day Left') }}</th>
                                        <th>{{ trans('admin.Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $subscription->id }}</td>
                                        <td>{{ $subscription->user->details->name }}</td>
                                        <td>{{ $subscription->plan->name }}</td>
                                        <td>{{ $subscription->plan->duration }}</td>
                                        <td>{{ $subscription->start_at }}</td>
                                        <td>{{ $subscription->end_at }}</td>
                                        <td><span
                                                class="badge badge-{{ $subscription->status }}">{{ trans('admin.' . $subscription->status) }}</span>
                                        </td>
                                        <td>{{ $subscription->day_left }}</td>
                                        <td>{{ number_format($subscription->total, 3) }} {{ trans('admin.KWD') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Meals') }}</h5>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('admin.Name') }}</th>
                                        <th>{{ trans('admin.Quantity') }}</th>
                                        <th>{{ trans('admin.Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscription->meals as $meal)
                                        <tr>
                                            <td>{{ $meal->meal->name }}</td>
                                            <td>{{ $meal->quantity }}</td>
                                            <td>{{ number_format($meal->total, 3) }} {{ trans('admin.KWD') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Frozen Days') }}</h5>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('admin.Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>15-2-2023</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="printArea" class="page" style="width: 100% ;background-color: #fff">
        <div style="margin-top: 5px ;margin-bottom: 5px !important ;display: block">
            <div style="width: 70% ;display: inline;float: right ;margin-bottom: 5px !important">
                <h6>{{ trans('admin.Subscription ID') }} : #{{ $subscription->id }}</h6>
                <h6>{{ trans('admin.Customer') }} : {{ $subscription->user->name }}</h6>
                <h6>{{ trans('admin.Mobile') }} : {{ $subscription->user->mobile }}</h6>
                <h6>{{ trans('admin.Plan') }} : {{ $subscription->plan->name }}</h6>
                <h6>{{ trans('admin.Start Date') }} : {{ $subscription->start_at }}</h6>
                <h6>{{ trans('admin.End Date') }} : {{ $subscription->end_at }}</h6>

                <hr>
                <h6>{{ trans('admin.Address') }} :
                    {{ trans('admin.City') }} : {{ $subscription->address->area->city->name }} -
                    {{ trans('admin.Area') }} : {{ $subscription->address->area->name }} -
                    {{ trans('admin.Street') }} : {{ $subscription->address->street }} -
                    {{ trans('admin.Floor') }} : {{ $subscription->address->floor }} -
                    {{ trans('admin.Apartment No') }} : {{ $subscription->address->apartment_no }}
                </h6>
            </div>
            <div style="width: 28% ;display: inline;float: left;">
                <h1>{{ settings()->name }}</h1>
            </div>
        </div>
        <hr>
        <div style="margin-top: 5px ;display: inline-block;width: 100%">
            <h3>{{ trans('admin.Meals') }}</h3>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('admin.Name') }}</th>
                        <th>{{ trans('admin.Quantity') }}</th>
                        <th>{{ trans('admin.Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscription->meals as $meal)
                        <tr>
                            <td>{{ $meal->meal->name }}</td>
                            <td>{{ $meal->quantity }}</td>
                            <td>{{ number_format($meal->total, 3) }} {{ trans('admin.KWD') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div style="margin-top: 5px ;display: inline-block;width: 100%">
            <h3>{{ trans('admin.Frozen Days') }}</h3>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('admin.Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15-2-2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div style="margin-top: 20px ;display: block;height: 50px;">
            <span style="float:left">
                <h6>{{ trans('admin.Total') }} : {{ $subscription->total }}
                    {{ trans('admin.KWD') }}
                </h6>
            </span>
        </div>
    </div>

    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9WrnlK7BbHl0PZpA7BgenNWnOIVoVQOY"></script>
        <script>
            function printpage() {
                var getpanel = document.getElementById("printArea");
                var MainWindow = window.open('', '', 'height=1000,width=1280');
                MainWindow.document.write('<html dir="rtl"><head><title></title>');
                MainWindow.document.write(
                    "<link rel=\"stylesheet\" href=\"{{ asset('dashboard') }}/assets/css/vendors/bootstrap.css\" type=\"text/css\"/>"
                );
                MainWindow.document.write(
                    "<link rel=\"stylesheet\" href=\"{{ asset('dashboard') }}/assets/css/custom-rtl.css\" type=\"text/css\"/>"
                );
                MainWindow.document.write(
                    "<link rel=\"stylesheet\" href=\"{{ asset('dashboard') }}/assets/css/print.css\" type=\"text/css\"/>"
                );
                MainWindow.document.write('</head><body onload="window.print();window.close()">');
                MainWindow.document.write(getpanel.innerHTML);
                MainWindow.document.write('</body></html>');
                MainWindow.document.close();
                setTimeout(function() {
                    MainWindow.print();
                }, 500)
                return false;
            }

            $("#changeStatus").click(function() {
                $("#statusModal").modal('show');
            });
        </script>
    @endpush
@endsection
