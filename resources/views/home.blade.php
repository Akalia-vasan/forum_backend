@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Welcome {{ auth()->user()->name }}!</strong>
                </div><!--card-header-->
                <div class="card-body">
                Welcome to the Dashboard
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
