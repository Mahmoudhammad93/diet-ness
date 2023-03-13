@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    {{ $title }}
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
                                    <th>{{ trans('admin.Active') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>
                                            @if ($company->default == 0)
                                            <i class="fas fa-times text-danger"></i>
                                            @else
                                            <i class="fas fa-check text-success"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($company->default == 0)
                                            <a href="{{ aurl('settings/payment_companies_store/' . $company->id) }}"
                                                class="btn btn-pill btn-outline-info btn-air-info"><i
                                                    class="fas fa-check"></i>
                                                {{ trans('admin.Default') }}</a>
                                            @endif
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

@endsection
