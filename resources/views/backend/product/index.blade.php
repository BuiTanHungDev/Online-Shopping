@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a>Products
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-secondary"><i
                                class="fa-regular fa-plus"></i> Create Product</a>
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>

                        <li class="breadcrumb-item active">Product</li>
                    </ul>
                    <p class="float-right">Total Product :{{ \App\Models\Product::count() }}</p>
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
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <td>Discount</td>
                                <th>Size</th>
                                {{-- <th>Description</th>
                                <th>Stock</th> --}}


                                <th>Condition</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($products as $product)

                                @php
                                    $photo = explode(",", $product->photo);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->title }}</td>
                                    {{-- <td>{!!html_entity_decode($product->description)  !!}</td> --}}
                                    <td>
                                        <img src="{{ $photo[0]}}" alt="banner image"
                                            style="max-height: 90px; max-width: 120px;">
                                    </td>
                                    <td>
                                        ${{ number_format($product->price, 2) }}
                                    </td>
                                    <td>
                                        {{ $product->discount }}%
                                    </td>
                                    <td>{{ $product->size }}</td>
                                    <td>
                                        @if ($product->condition == 'new')
                                            <span class=" badge badge-success">{{ $product->condition }}</span>
                                        @elseif ($product->condition == 'popular')
                                            <span class=" badge badge-primary">{{ $product->condition }}</span>
                                        @else
                                            <span class=" badge badge-primary">{{ $product->condition }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" name="toogle" value="{{ $product->id }}"
                                            data-toggle="switchbutton" {{ $product->status == 'active' ? 'checked' : '' }}
                                            data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                            data-onstyle="success" data-offstyle="danger">
                                    </td>
                                    <td>
                                        <a href="{{route('product.show',$product->id)}}" data-toggle="tooltip"
                                            title="add attribute"
                                            data-placement="bottom"
                                            class="float-left ml-2 btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>

                                        <a href="javascript:void(0);" data-toggle="modal"
                                        data-target="#productId{{ strval($product->id) }}" title="view"
                                        data-placement="bottom"
                                        class="float-left ml-2 btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                        
                                        {{-- Modal cho  mỗi sản phẩm --}}
                                        <div class="modal fade" id="productId{{ strval($product->id) }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                @php
                                                    $product = \App\Models\Product::where('id', $product->id)->first();
                                                @endphp
                                               
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ \Illuminate\Support\Str::upper($product->title) }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <strong>Summary:</strong>
                                                                <p>{!! html_entity_decode($product->summary) !!}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <strong>Description:</strong>
                                                                <p>{!! html_entity_decode($product->description) !!}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Price:</strong>
                                                                <p>{{ number_format($product->price, 2) }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Offer Price:</strong>
                                                                <p>{{ number_format($product->offer_price, 2) }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Stock:</strong>
                                                                <p>{{ $product->stock }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Category:</strong>
                                                                <p>{{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Child Category:</strong>
                                                                <p>{{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Brand:</strong>
                                                                <p>{{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Vendor:</strong>
                                                                <p>{{ \App\Models\User::where('id', $product->vendor_id)->value('full_name') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Size:</strong>
                                                                <p class="badge badge-success">{{ $product->size }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Condition:</strong>
                                                                <p class="badge badge-primary">{{ $product->condition }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Status:</strong>
                                                                <p class="badge badge-primary">{{ $product->status }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <strong>Discount:</strong>
                                                                <p>{{ $product->discount }}%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <a href="{{ route('product.edit', $product->id) }}" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"
                                            class="float-left ml-2 btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post"
                                            class="float-left ml-2">

                                            @method('delete')
                                            <a href=""data-id="{{ $product->id }}" data-toggle="tooltip"
                                                title="delete" data-placement="bottom"
                                                class="dltBtn  btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @csrf
                                        </form>

                                    </td>
                                </tr>
                            @endforeach


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
