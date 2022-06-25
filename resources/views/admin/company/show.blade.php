@extends('layouts.app')

@section('title', 'Company Management' . ' | ' .'Company View')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="{{ route('admin.auth.user.index') }}" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Company</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.user.create') }}">Create Company</a>
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
                    Company Management
                    <small class="text-muted">Company View</small>
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
                                        <th>Logo</th>
                                        <td>
                                            @if(!empty($company->logo))
                                                <img src="{{ asset('storage/'.$company->logo) }}" class="user-profile-image" width="150px"  height="150px"/>
                                            @else
                                            <img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" class="user-profile-image" />
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cover Image</th>
                                        <td>
                                            @if(!empty($company->cover_image))
                                                <img src="{{ asset('storage/'.$company->cover_image) }}" class="user-profile-image" width="150px" height="150px"/>
                                            @else
                                            <img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" class="user-profile-image" />
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $company->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $company->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone</th>
                                        <td>
                                        {{$company->telephone}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>
                                        {{$company->address}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td>
                                        {{$company->website}}

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
                    <strong>Created At:</strong> {{ timezone()->convertToLocal($company->created_at) }} ({{ $company->created_at->diffForHumans() }}),
                    <strong>Last Updated:</strong> {{ timezone()->convertToLocal($company->updated_at) }} ({{ $company->updated_at->diffForHumans() }})
                    @if($company->deleted_at != null)
                        <strong>Deleted At:</strong> {{ timezone()->convertToLocal($company->deleted_at) }} ({{ $company->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
