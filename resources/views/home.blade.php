@extends('layouts.app')

@section('content')
<div class="container" id="comments">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form id="post-search">  
                        <div class="form-group has-search">
                            <input type="text" class="form-control bg-white" placeholder="Search" name="name" id="search-input" value="">
                        </div>
                    </form>
                </div>
                <div class="post-search-data">
                    @include('includes.partials._dashboard-part')
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<script>
        $('#post-search').on('focusout', '#search-input', function () {
            ajaxfilter();
        });

      function ajaxfilter(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $("#overlay").show();
          $.ajax({
              type:'POST',
              url:'{{ route('auth.post.search')}}',
              data:$("#post-search").serialize(),
              success:function(data) {
                  //alert(data);
                  setTimeout(function(){
                      $(".post-search-data").html(data);
                      $("#overlay").hide();
                  },200);

              }
          });
      }
</script>
@endsection
