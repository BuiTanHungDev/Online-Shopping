@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a>Order
                    </h2>
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
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-dark">
                            <tr>

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

                            <tr>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->payment_method == 'cod' ? 'Cash on Delivery ' : $order->payment_method }}
                                </td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td><span
                                        class="badge 
                                        @if ($order->condition == 'pending') badge-info
                                        @elseif($order->condition == 'processing') 
                                        badge-primary
                                        @elseif($order->condition == 'delivered')
                                        badge-success
                                        @else 
                                        badge-danger @endif">{{ $order->condition }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}" data-toggle="tooltip" title="download"
                                        data-placement="bottom" class="float-left btn btn-sm btn-outline-info">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="post"
                                        class="float-left ml-2">

                                        @method('delete')
                                        <a href=""data-id="{{ $order->id }}" data-toggle="tooltip" title="delete"
                                            data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @csrf
                                    </form>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-dark">
                            <tr>

                                <th>S.N</th>
                                <th>Product Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($order->products->isNotEmpty())
                                @foreach ($order->products as $item)
                                    <tr>
                                        <td></td>
                                        <td><img src="{{ $item->photo }}" style="max-width: 100px;" alt=""></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>${{ number_format($item->offer_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No products found</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-5 border py-5">

                    <p><Strong>Subtotal:</Strong> ${{ number_format($order->sub_total, 2) }}</p>
                    @if ($order->delivery_charge > 0)
                        <p><strong>Shipping cost:</strong> ${{number_format($order->delivery_charge,2)}}</p>
                    @endif

                    @if ($order->coupon > 0)
                        <p>
                            <strong> Coupon:</strong>
                            ${{number_format($order->coupon,2)}}
                        </p>
                    @endif

                    <p><Strong>Total:</Strong>${{ number_format($order->total_amount, 2) }}</p>


                    <form action="{{route('order.status',$order->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <strong>Status</strong>
                        {{-- <select name="condition" class="form-control" id="">
                            <option value="pending"{{$order->condition=='pending' ? 'selected' : ''}}>Pending</option>
                            <option value="processing" {{$order->condition=='processing' ? 'selected' : ''}}>Processing</option>
                            <option value="delivery"{{$order->condition=='delivered' ? 'selected' : ''}}>Delivered</option>
                           
                            <option value="cancelled"{{$order->condition=='delivered' ? 'disabled' : ''}} {{$order->condition=='cancelled' ? 'selected' : ''}}>Cancelled</option>
                            
                        </select> --}}
                        <select name="condition" class="form-control">
                            <option value="pending" {{$order->condition == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="processing" {{$order->condition == 'processing' ? 'selected' : ''}}>Processing</option>
                            <option value="delivered" {{$order->condition == 'delivered' ? 'selected' : ''}}>Delivered</option>
                            <option value="cancelled" {{$order->condition == 'cancelled' ? 'selected' : ''}}{{$order->condition == 'delivered' || $order->condition == 'cancelled' ? 'disabled' : ''}}>Cancelled</option>
                        </select>
                        

                        <button type="submit" class="btn btn-sm btn-success mt-5">Update</button>
                    </form>

                </div>

                <div class="col-1"></div>
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
