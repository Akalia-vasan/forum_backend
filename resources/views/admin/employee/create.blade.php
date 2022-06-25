@extends('layouts.app')

@section('title', 'Employee Management' . ' | ' . 'Employee Create')

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
{{ Form::open(['route' => 'admin.auth.employee.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Employee Management
                    <small class="text-muted">Employee Create</small>
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
                    {{ Form::label('first_name', 'First Name', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('First Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('last_name', 'Last Name', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('Last Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('email', __('Email'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('Email')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('telephone', __('Phone'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => trans('Phone')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('profile_image', trans('Profile Image'), ['class' => 'col-md-2 from-control-label']) }}

                    
                    <div class="col-lg-5">
                    <input type="file" name="profile_image" placeholder="Choose file" id="profile_image" accept="image/png, image/gif, image/jpeg">
                    </div>
                </div>
               
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('company_id', 'Company', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                    {{ Form::select('company_id', $companies, null, ['class' => 'form-control company box-size', 'data-placeholder' => trans('Company')]) }}
                    
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('gender', 'Gender', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                    {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), 'Male', ['class' => 'form-control select2']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
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
        FTX.Companies.edit.init(("create"));
    });
</script>
@endsection