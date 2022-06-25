@extends('layouts.app')

@section('title', 'Company Management' . ' | ' . 'Company Edit')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="{{ route('admin.auth.user.index') }}" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Company</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.user.create') }}">Edit Company</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
{{ Form::model($company, ['route' => ['admin.auth.company.update', $company], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true, 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Company Management
                    <small class="text-muted">Company Edit</small>
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
                    {{ Form::label('name', 'Name', [ 'class'=>'col-md-2 form-control-label required']) }}

                    <div class="col-md-10">
                        {{ Form::text('name', $company->name, ['class' => 'form-control', 'placeholder' => trans('Name')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('email', __('Email'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('email', $company->email, ['class' => 'form-control', 'placeholder' => trans('Email')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('telephone', __('Phone'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('telephone', $company->telephone, ['class' => 'form-control', 'placeholder' => trans('Phone')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('logo', trans('Logo'), ['class' => 'col-md-2 from-control-label']) }}
                    @if(!empty($company->logo))
                        <div class="col-lg-1">
                            <img src="{{ asset('storage/'.$company->logo) }}" height="80" width="80">
                        </div>
                        <div class="col-lg-5">
                        <input type="file" name="logo" placeholder="Choose file" id="logo" accept="image/png, image/gif, image/jpeg" onchange="validateimg(this)">
                        </div>
                        @else
                        <div class="col-lg-5">
                        <input type="file" name="logo" placeholder="Choose file" id="logo" accept="image/png, image/gif, image/jpeg" onchange="validateimg(this)">
                        </div>
                    @endif
                </div>

                <div class="form-group row">
                    {{ Form::label('cover_image', trans('Cover Image'), ['class' => 'col-md-2 from-control-label']) }}

                    @if(!empty($company->cover_image))
                        <div class="col-lg-1">
                            <img src="{{ asset('storage/'.$company->cover_image) }}" height="80" width="80">
                        </div>
                        <div class="col-lg-5">
                        <input type="file" name="cover_image" placeholder="Choose file" id="cover_image" accept="image/png, image/gif, image/jpeg">
                        </div>
                        @else
                        <div class="col-lg-5">
                        <input type="file" name="cover_image" placeholder="Choose file" id="cover_image" accept="image/png, image/gif, image/jpeg">
                        </div>
                    @endif
                </div>
               
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('address', 'Address', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('Address')]) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('website', 'Website', [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => trans('Website')]) }}
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
    function validateimg(ctrl) { 
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        if (height < 100 || width < 100) {
                            alert("At least you can upload a 1100*750 photo size.");
                            return false;
                        }else{
                            alert("Uploaded image has valid Height and Width.");
                            return true;
                        }
                    };
                }
            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        } else {
            alert("Please select a valid Image file.");
            return false;
        }
    }
</script>
@endsection