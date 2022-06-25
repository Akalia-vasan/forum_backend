@extends('layouts.app')

@section('title', 'Users Management' . ' | ' . 'Users Update')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="{{ route('admin.auth.user.index') }}" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.user.create') }}">Create User</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
{{ Form::model($user, ['route' => ['admin.auth.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Users Management
                    <small class="text-muted">Users Update</small>
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
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    {{ Form::label('name', 'Full Name', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => trans('Full Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('email', __('Email'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => trans('Email')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                
                <div class="form-group row">
                    {{ Form::label('status', trans('Associated Roles'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-8">
                        @if (isset($roles) && count($roles) > 0)
                        @foreach($roles as $role)
                        <label for="role-{{$role->id}}" class="control">
                            <input type="radio" value="{{$role->id}}" name="assignees_role" {{ $role->id == 3 ? 'checked' : '' }} id="role-{{$role->id}}" class="get-role-for-permissions" /> &nbsp;&nbsp;{!! $role->name !!}
                        </label>
                        <!--permission list-->
                        @endforeach
                        @else
                        {{ trans('No Roles') }}
                        @endif
                    </div>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    {{ Form::submit('Update', ['class' => 'btn btn-success btn-sm pull-right']) }}
</div>
<!--card-->
{{ Form::close() }}
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Users.edit.init("create");
    });
</script>
@endsection