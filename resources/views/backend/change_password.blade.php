@extends("backend.layout")
@section("do-du-lieu")
<div class="container-fluid px-4">
<div class="col-md-12 mt-5">  
        <div class="panel panel-primary">
        @if(session()->has('successMsg'))
        <div class="alert alert-success" role="alert">
            {{session()->get('successMsg')}}
        </div>
        @endif
        @if(session()->has('errorMsg'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('errorMsg')}}
        </div>
        @endif
        <div class="panel-heading">
            <h1>Change your password</h1>
        </div>
        <div class="panel-body mt-5">
        <form method="post" action="{{url('change-password/'.Auth::user()->id )}}" enctype="multipart/form-data">
            @csrf
            <div class="row mt-3">
                <div class="col-md-2">Current password:</div>
                <div class="col-md-6">
                    <input type="password" 
                        name="currentpass" 
                        class="form-control" 
                        required
                    >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">New password:</div>
                <div class="col-md-6">
                    <input type="password" 
                        name="newpass" 
                        class="form-control" 
                        required
                    >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">Confirm password:</div>
                <div class="col-md-6">
                    <input type="password" 
                        name="confirmpass" 
                        class="form-control" 
                        required
                    >
                </div>
            </div>              
            <!-- Button -->
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary ml-3 btn_create_update">Save</button>
                </div>
                <div class="col-md-1">
                    <a type="button" href="" class="btn btn-primary ml-3 btn_create_update cancel">Cancel</a>
                </div>
            </div>
            <!-- Button end -->
        </form>
        </div>
    </div>
</div>
@include('backend.form-error')
</div>
<script>
   $(document).ready(function(){
        setTimeout(function()
        {
            $("div.alert").remove();
        },3000);
    });
    
</script>

@endsection("do-du-lieu")
