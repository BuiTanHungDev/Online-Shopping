@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                     <h2 >
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Order
                        {{-- <a href="{{route('coupon.create')}}" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-plus"></i> Create Coupon</a> --}}
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fa-regular fa-house"></i></a></li>
                        
                        <li class="breadcrumb-item active">Order List</li>
                    </ul>
                    <p class="float-right">Total Orders :{{\App\Models\Order::count()}}</p>
                    </div>
            </div>
        </div>

           

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
         
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>


                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->first_name}} {{$item->last_name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->payment_method == "cod" ? "Cash on Delivery " :$item->payment_method }}</td>
                                    <td>{{ucfirst($item->payment_method)}}</td>
                                    <td>${{number_format($item->total_amount,2)}}</td>
                                    <td><span class="badge 
                                        @if($item->condition=='pending')
                                        badge-info
                                        @elseif($item->condition=='processing') 
                                        badge-primary
                                        @elseif($item->condition=='delivered')
                                        badge-success
                                        @else 
                                        badge-danger
                                        
                                    @endif">{{$item->condition}}</span></td>
                                    <td>
                                        <a href="{{ route('order.show', $item->id) }}" data-toggle="tooltip"
                                            title="view" data-placement="bottom" class="float-left btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form  action="{{route('order.destroy',$item->id) }}" method="post" class="float-left ml-2">
                                            
                                            @method('delete')
                                            <a href=""data-id="{{$item->id}}" data-toggle="tooltip"  title="delete"
                                            data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @csrf
                                        </form>
                                    </td>
                                    
                                </tr>
                                 @empty 
                                 <tr>
                                    <td colspan="8">No order</td></tr>
                                 @endforelse
                                
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
@endsection


@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });


        });
    </script>
    <script>
        $('input[name= toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);

            $.ajax({
                url: "{{ route('coupon.status') }}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.msg);

                    } else {
                        alert('please try again');
                    }
                }

            })
        });
    </script>
@endsection
