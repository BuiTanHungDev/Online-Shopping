@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a>Products

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>

                        <li class="breadcrumb-item active">Product Attribute</li>
                    </ul>
                </div>
            </div>
        </div>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <div class="header">
                        <h2><strong>{{ ucfirst($product->title) }}</strong></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <form action="{{ route('product.attribute', $product->id) }}" method="POST">
                                @csrf

                                <div id="product_attribute" class="content"
                                    data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                    <div class="row">
                                        <div class="col-md-12"><button type="button" id="btnAdd-1"
                                                class="btn btn-sm my-2 btn-primary"><i
                                                    class="fas fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                    <div class="row group">
                                        <div class="col-md-2">
                                            <label for="">Size</label>
                                            <input class="form-control form-control-sm" min="35" max="42"
                                                name="size[]" type="number">
                                        </div>
                                        <div class="col-md-3 ">
                                            <label for="">Original Price</label>
                                            <input class="form-control form-control-sm" step="any"
                                                name="original_price[]" type="number">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Offer Price</label>
                                            <input class="form-control form-control-sm" name="offer_price[]" step="any"
                                                type="number">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Stock</label>
                                            <input class="form-control form-control-sm" name="stock[]" type="number">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="btn btn-sm mt-4 btn-danger btnRemove">Remove</button>
                                        </div>


                                    </div>


                                </div>

                                <button type="submit" style="margin-top: 15px" class="btn  btn-sm btn-info"> Submit
                                </button>
                            </form>

                        </div>
                        <div class="col-md-5">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        
                                            <th>Size</th>
                                            <th>Original </th>
                                            <th>Offer</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($productAttr) > 0)
                                            @foreach ($productAttr as $item)
                                                <tr>
                                                    
                                                    <td>{{ $item->size }}</td>
                                                    <td>${{ number_format($item->original_price,2) }}</td>
                                                    <td>${{ number_format($item->offer_price,2) }}</td>
                                                    <td>{{ $item->stock }}</td>
                                                    <td>
                                                        <form action="{{ route('product.attribute.destroy', $item->id) }}"
                                                            method="post" class="float-left ml-2">

                                                            @method('delete')
                                                            <a href=""data-id="{{ $item->id }}"
                                                                data-toggle="tooltip" title="delete" data-placement="bottom"
                                                                class="dltBtn  btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                            @csrf
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="body">

                    </div>

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
    {{-- add attribute --}}
    <script>
        $('#product_attribute').multifield();
    </script>

    {{-- ------------------ --}}

    {{-- ------------------------------------------------ --}}
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
    {{-- ---------------------------------------------------------- --}}
    <script>
        $('input[name= toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);

            $.ajax({
                url: "{{ route('product.status') }}",
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
