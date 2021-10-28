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
    <div class="card-header">
        <div class="row">    
            <h4 class="card-title">Client information</h4>
        </div>
    </div>
        <div class="panel-body mt-4">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                   <p>{{ isset($record->name)?$record->name:'' }}</p>
                </div>
            </div>
            <!-- end rows -->
             <!-- rows -->
             <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Username</div>
                <div class="col-md-10">
                   <p>{{ isset($record->username)?$record->username:'' }}</p>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Email</div>
                <div class="col-md-10">
                <p>{{ isset($record->email)?$record->email:'' }} </p>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Address</div>
                <div class="col-md-10">
                   <p>{{ isset($record->address)?$record->address:'' }}</p>
                </div>
            </div>
            <!-- end rows -->
             <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Phone</div>
                <div class="col-md-10">
                    <p>{{ isset($record->phonenumber)?$record->phonenumber:'' }}</p>
                </div>
            </div>
             <!-- rows -->
             <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Created_at</div>
                <div class="col-md-10">
                   <p>{{ isset($record->created_at)?$record->created_at:'' }}</p>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
            <div class="col-md-2">Function</div>
            <div class="col-md-10">
                 <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Change</button>
            </div>
            </div>
            <!-- end rows -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-body">
                    <form method="post" action="{{ url('change-info/'.$record->id) }}" enctype="multipart/form-data">
                        @csrf
                        <!-- rows -->
                        <div class="row" style="margin-top:5px;">
                            <div class="col-md-2">Name</div>
                            <div class="col-md-10">
                                <input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
                            </div>
                        </div>
                        <!-- end rows -->
                        <!-- rows -->
                        <div class="row" style="margin-top:5px;">
                            <div class="col-md-2">Email</div>
                            <div class="col-md-10">
                                <input type="email" value="{{ isset($record->email)?$record->email:'' }}" @if(isset($record->email)) disabled @endif name="email" class="form-control" required>
                            </div>
                        </div>
                        <!-- end rows -->

                        <div class="row" style="margin-top:5px;">
                            <div class="col-md-2">Address</div>
                            <div class="col-md-10">
                                <input type="text" value="{{ isset($record->address)?$record->address:'' }}" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-md-2">Phone</div>
                            <div class="col-md-10">
                                <input type="text" value="{{ isset($record->phonenumber)?$record->phonenumber:'' }}" name="phonenumber" class="form-control" required>
                            </div>
                        </div>
                    </div>
               </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    @include('backend.form-error')
</div>
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