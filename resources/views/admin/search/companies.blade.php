@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>

                <a href="{{ aurl('companies/create') }}" class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                    {{ trans('admin.Add New Company') }}</a>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover mb-4">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('admin.Profile') }}</th>
                                <th>{{ trans('admin.Name') }}</th>
                                <th>{{ trans('admin.Email') }}</th>
                                <th>{{ trans('admin.Mobile') }}</th>
                                <th>{{ trans('admin.Types') }}</th>
                                <th>{{ trans('admin.Show In Home') }}</th>
                                <th>{{ trans('admin.Views') }}</th>
                                <th>{{ trans('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td><img src="{{ ($admin->profile()->exists())?$admin->profile->url:"" }}" class="img-40 m-r-15 rounded-circle align-top" width="60" alt="">
                                    </td>
                                    <td>{{ $admin->company->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>
                                        @foreach ($admin->types as $type)
                                            <span class="badge badge-primary">{{ $type->name }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($admin->company->in_home)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-primary"></i>
                                        @endif
                                    </td>
                                    <td>{{ $admin->company->views }}</td>
                                    <td>
                                        <div class="dropdown-basic">
                                            <div class="dropdown">
                                                <button class="dropbtn btn-primary"
                                                    type="button">{{ trans('admin.Actions') }}
                                                    <span><i class="icofont icofont-arrow-down"></i></span></button>
                                                <div class="dropdown-content">
                                                    <a href="{{ aurl('companies/logs/' . $admin->id) }}" class="dropdown-item"><i class="fas fa-chart-line"></i> {{ trans('admin.Activity') }}</a>
                                                <a href="{{ aurl('companies/edit/' . $admin->id) }}" class="dropdown-item"><i class="fas fa-edit"></i> {{ trans('admin.Edit') }}</a>
                                                <a href="{{ aurl('companies/store/' . $admin->id) }}" class="dropdown-item"><i class="fas fa-store"></i> {{ trans('admin.Store') }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" data-id="{{ $admin->id }}" data-name="{{ $admin->name }}" id="delete" class="dropdown-item"><i class="fas fa-trash"></i> {{ trans('admin.Delete') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $admins->links('admin.pagination.index') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Delete') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('admins/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-primary" id="adminName"></p>
                        </div>
                        <input type="hidden" id="admin_id" name="admin_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>
                        <button type="submit" class="btn btn-pill btn-outline-danger btn-air-danger">{{ trans('admin.Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#delete ").click(function() {
                    var adminName = $(this).attr('data-name');
                    var adminId = $(this).attr('data-id');
                    $("#adminName").text(adminName);
                    $("#admin_id").val(adminId);
                    $("#deleteModal").modal('show');
                });
            });
        </script>
    @endpush
@endsection
