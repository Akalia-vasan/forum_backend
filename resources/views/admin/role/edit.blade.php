@extends('layouts.app')

@section('title', 'Role Management' . ' | ' . 'Role Update')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Role</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.role.create') }}">Edit Role</a>
            </div>
        </div><!--dropdown-->
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@e
@endsection

@section('content')
{{ Form::model($role, ['route' => ['admin.auth.role.update', $role], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Roles Management
                    <small class="text-muted">Role Create</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="row mt-4">
            <div class="col">
                <div class="form-group row">
                    {{ Form::label('name', 'Name', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('Role Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('associated_permissions', 'Associated Permissions', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10 search-permission" style="min-height: unset;">

                        <!-- {{ Form::select('associated_permissions', array('all' => trans('All'), 'custom' => trans('Custom')), 'all', ['class' => 'form-control select2']) }} -->

                        <div id="available-permissions" style="margin-top: 20px;">
                            <!-- <div>
                                <input type="text" class="form-control search-button" placeholder="Search..." />
                            </div> -->
                            <div class="get-available-permissions">
                                @if ($permissions->count())
                                @foreach ($permissions as $perm)
                                <div>
                                    <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $rolePermissions) ? 'checked' : '') }} /> <label style="margin-left:20px;" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
                                </div>
                                @endforeach
                                @else
                                <p>There are no available permissions.</p>
                                @endif
                                <!--col-lg-6-->
                            </div>
                            <!--row-->
                        </div>
                        <!--available permissions-->
                    </div>
                    <!--col-->
                </div>
                <!--form control-->
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    {{ Form::submit('Create', ['class' => 'btn btn-success btn-sm pull-right']) }}
</div>
<!--card-->
{{ Form::close() }}
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        // FTX.Roles.edit.init(" ");
    });
</script>
@endsection