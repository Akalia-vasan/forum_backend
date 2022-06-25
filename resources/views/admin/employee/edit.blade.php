@extends('layouts.app')

@section('title', 'Employee Management' . ' | ' . 'Employee Edit')

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
{{ Form::model($employee, ['route' => ['admin.auth.employee.update', $employee], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true, 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Employee Management
                    <small class="text-muted">Employee Edit</small>
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
                        {{ Form::text('first_name', $employee->first_name, ['class' => 'form-control', 'placeholder' => trans('First Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('last_name', 'Last Name', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('last_name', $employee->last_name, ['class' => 'form-control', 'placeholder' => trans('Last Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('email', __('Email'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('email', $employee->email, ['class' => 'form-control', 'placeholder' => trans('Email')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('telephone', __('Phone'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('telephone', $employee->telephone, ['class' => 'form-control', 'placeholder' => trans('Phone')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('profile_image', trans('Profile Image'), ['class' => 'col-md-2 from-control-label']) }}

                    @if(!empty($employee->profile_image))
                        <div class="col-lg-1">
                            <img src="{{ asset('storage/'.$employee->profile_image) }}" height="80" width="80">
                        </div>
                        <div class="col-lg-5">
                        <input type="file" name="profile_image" placeholder="Choose file" id="profile_image" accept="image/png, image/gif, image/jpeg">
                        </div>
                        @else
                        <div class="col-lg-5">
                        <input type="file" name="profile_image" placeholder="Choose file" id="profile_image" accept="image/png, image/gif, image/jpeg">
                        </div>
                    @endif
                </div>
               
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('company_id', 'Company', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                    {{ Form::select('company_id', $companies, $employee->company_id, ['class' => 'form-control company box-size', 'data-placeholder' => trans('Company')]) }}
                    
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('gender', 'Gender', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                    {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), $employee->gender, ['class' => 'form-control select2']) }}
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

    {{ Form::submit('Update', ['class' => 'btn btn-success btn-sm pull-right']) }}
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