@extends("backend.layout")
@section("do-du-lieu")
<?php
use App\Models\Product;
?>
<div class="container-fluid px-4">
<div class="col-md-12 mt-5">
    <div style="margin-bottom:25px;">
        <input onclick="history.go(-1);" type="button" value="Back" class="btn btn-danger">
    </div>    
    <div class="panel panel-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                <strong class="card-title">Order detail</strong>
            </div>
        </div>
    </div>
        <div class="panel-body">
            <!-- thong tin don hang -->
            <table class="table">
                <tr>
                    <td style="width: 150px;">Name: </td>
                    <td>{{$record->customuser->name}}</td>
                </tr>
                <tr>
                    <td style="width: 150px;">Address: </td>
                    <td>{{$record->customuser->address}}</td>
                </tr>
                <tr>
                    <td style="width: 150px;">Phone number: </td>
                    <td>{{$record->customuser->phonenumber}}</td>
                    
                </tr>
                <tr>
                    <td style="width: 150px;">Total price: </td>
                    <td>{{$record->price}}$</td>   
                </tr>
                <tr>
                    <td style="width: 150px;">Date ordered: </td>
                    <td>{{$record->date}}</td>
                </tr>
                <tr>
                    <td style="width: 150px;">Status: </td>
                    <td>
                    @if($record->status == 1)
                        <span class="badge rounded-pill bg-success">Shipped</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Not shipped yet</span>
                    @endif
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-bordered table-dark js-sort-table">
                <tr>
                    <th style="width: 100px;">Photo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Hot</th>
                    <th>Quantity</th>
                </tr>
                @foreach($order_detail as $rows)
                    <?php              
                        $products = Product::where('id','=',$rows->product_id)->get();
                     ?>
                <tr>
                    @foreach($products as $product)
                    <td style="text-align: center;" style="width:100px;"><img width="100%;" src="{{asset('images/'.$product->photo)}}"></td>
                    <td>{{$product->name;}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$rows->price}}$</td>
                    <td>{{$product->discount}}%</td>
                    <td>
                        @if($product->hot == 1)
                        <i class="fas fa-check ml-3" style="color:green"></i>
                        @else
                        <i class="fas fa-times ml-3" style="color:red"></i>
                        @endif
                    </td>
                    <td>{{$rows->quantity}}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>      
           
            <!-- /thong tin -->
                 
        </div>
    </div>
</div>
</div>
@endsection