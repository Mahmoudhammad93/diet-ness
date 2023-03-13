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
                                @foreach ($methods as $method)
                                    <tr>
                                        <td>{{ $method->id }}</td>
                                        <td>{{ $method->name }}</td>
                                        <td>
                                            @if ($method->active == 0)
                                            <i class="fas fa-times text-danger"></i>
                                            @else
                                            <i class="fas fa-check text-success"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($method->active == 0)
                                            <a href="{{ aurl('settings/payment_methods_store/1/' . $method->id) }}"
                                                class="btn btn-pill btn-outline-info btn-air-info"><i
                                                    class="fas fa-check"></i>
                                                {{ trans('admin.Activated') }}</a>
                                            @else
                                            <a href="{{ aurl('settings/payment_methods_store/0/' . $method->id) }}"
                                                class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-times"></i>
                                                {{ trans('admin.Stop') }}</a>
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
