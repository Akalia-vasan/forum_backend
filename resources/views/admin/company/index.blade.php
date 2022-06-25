@extends('layouts.app')

@section('title', 'My Task' . ' | ' . 'Company Management')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Company</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.company.create') }}">Create Company</a>
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
                Company Management <small class="text-muted">Active Companies</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive" style="overflow-y:visible;overflow-x:visible;">
                    <table class="table" id="pages-table" data-ajax_url="{{ route('admin.auth.company.get') }}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Pages.list.init();
    });
</script>
@endsection