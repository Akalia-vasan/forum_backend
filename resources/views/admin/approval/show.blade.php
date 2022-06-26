@extends('layouts.app')

@section('title', 'My Posts' . ' | ' . 'post Create')

@section('breadcrumb-links')
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        
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
        <section>
            <div class="container my-5 py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="card text-dark">
                            <div class="card-body p-4">
                                <div class="d-flex flex-start">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" alt="avatar" width="60"
                                        height="60" />
                                    <div>
                                        <h6 class="fw-bold mb-1">{{$post->user ? $post->user->name : 'Guest'}}</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <p class="mb-0">
                                            {{$post->created_at ? date('jS \of F Y', strtotime($post->created_at)) : ''}}
                                            <span class="badge bg-primary">{{ $post->flag }}</span>
                                            </p>
                                        </div>
                                        <p class="mb-0">
                                        {!! $post->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($post->status == 1)
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" alt="avatar" width="40"
                                    height="40" />
                                    <form name="form-copy" class="form-outline w-100">
                                        <div class="form-outline w-100">
                                            <textarea class="form-control" id="textAreaExample" rows="4" name="reason"
                                            style="background: #fff;" onchange="myFunction()"></textarea>
                                            <label class="form-label" for="textAreaExample">Reason</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    {!! Form::open(['url' => route('auth.post.approval.update', ['post' => $post->id]), 'class' => 'inline-form form']) !!}
                                        <input type="hidden" name="reason">
                                        <input type="hidden" name="status" value="2">
                                        {{ Form::submit('APPROVE', ['class' => 'btn btn-success btn-sm pull-right']) }}
                                    {!! Form::close() !!}
                                    {!! Form::open(['url' => route('auth.post.approval.update', ['post' => $post->id]), 'class' => 'inline-form']) !!}    
                                        <input type="hidden" name="reason">
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-danger btn-sm">REJECT</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    
    function myFunction() {
                var form = $('form[name="form-copy"]');
                console.log(11)
                $(('[name="reason"]')).val(form.find('[name="reason"]').val());
                return true;
            };
</script>
