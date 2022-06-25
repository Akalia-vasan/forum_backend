@extends('layouts.app')

@section('title', 'Employee Management' . ' | ' .'Employee View')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="{{ route('admin.auth.user.index') }}" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Employee</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.user.create') }}">Create Employee</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Employee Management
                    <small class="text-muted">Employee View</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> Overview</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Profile</th>
                                        <td>
                                            @if(!empty($employee->profile_image))
                                                <img src="{{ asset('storage/'.$employee->profile_image) }}" class="user-profile-image" width="150px"  height="150px"/>
                                            @else
                                            <img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" class="user-profile-image" />
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $employee->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $employee->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone</th>
                                        <td>
                                        {{$employee->telephone}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                        {{$employee->gender}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>
                                        {{$employee->company->name}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div><!--table-responsive-->

                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>Created At:</strong> {{ timezone()->convertToLocal($employee->created_at) }} ({{ $employee->created_at->diffForHumans() }}),
                    <strong>Last Updated:</strong> {{ timezone()->convertToLocal($employee->updated_at) }} ({{ $employee->updated_at->diffForHumans() }})
                    @if($employee->deleted_at != null)
                        <strong>Deleted At:</strong> {{ timezone()->convertToLocal($employee->deleted_at) }} ({{ $employee->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
