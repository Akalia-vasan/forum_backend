@extends('layouts.app')

@section('title', 'My Task' . ' | ' . 'Post Approval Management')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        
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
                Post Approval Management
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
                    <table class="table" id="pages-table" data-ajax_url="{{ route("auth.post.approval.get") }}">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th>Created At</th>
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