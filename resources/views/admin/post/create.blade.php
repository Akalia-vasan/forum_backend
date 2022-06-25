@extends('layouts.app')

@section('title', 'My Posts' . ' | ' . 'post Create')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Post</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('auth.role.create') }}">Create Post</a>
            </div>
        </div><!--dropdown-->
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
{{ Form::open(['route' => 'auth.post.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}
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
        <div class="form-group row">
                {{ Form::label('content', trans('Content'), ['class' => 'col-md-2 from-control-label']) }}

                <div class="col-md-10">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('Content')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
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
    });
</script>
@endsection