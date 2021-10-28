@extends("backend.layout")
@section("do-du-lieu")
<div class="container-fluid px-4">
<div class="animated fadeIn mt-5">

                <!-- Data table -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Orders History List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer</th>
                            <th>Total price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Customer</th>
                            <th>Total price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $rows)
                                        <tr>
                                            <td>{{$rows->id}}</td>
                                            <td>{{$rows->customuser->name}}</td>
                                            <td>{{$rows->price}}$</td>
                                            <td>{{$rows->date}}</td>
                                            <td>
                                                @if($rows->status == 1)
                                                    <span class="badge rounded-pill bg-success">Shipped</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Not shipped yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="badge badge-complete" style="color:black;" href="{{ url('show-detail-order/'.$rows->id) }}">
                                                <i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
                <!-- End data table -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                      {{ $data->links() }}
                                    </ul>
                                </nav>
</div>
<!-- .animated -->
</div>
@endsection