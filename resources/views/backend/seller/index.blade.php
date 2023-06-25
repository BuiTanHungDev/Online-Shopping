@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a>List Seller
                        <a href="{{ route('seller.create') }}" class="btn btn-sm btn-outline-secondary"><i
                                class="fa-regular fa-plus"></i> Create Seller</a>
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>

                        <li class="breadcrumb-item active">Seller</li>
                    </ul>
                    <p class="float-right">Total Sellers :{{ $sellers->count() }}</p>
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
                                <th>S.N</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Is verified</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sellers as $seller)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $seller->full_name }}</td>
                                    <td>{{ $seller->username }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td><img src="{{ $seller->photo == NUll ? \App\Utilities\Helpers::userDefaultImage() : asset($seller->photo) }}" alt="seller photo"
                                            style="max-height: 90px; max-width: 120px;"></td>

                                    <td>{{$seller->phone}}</td>

                                    <td>
                                        <input type="checkbox" name="is_verified" value="{{ $seller->is_verified }}"
                                            data-toggle="switchbutton" {{ $seller->is_verified  ? 'checked' : '' }}
                                            data-onlabel="Yes" data-offlabel="No" data-size="sm"
                                            data-onstyle="success" data-offstyle="danger">
                                    </td>
                                   
                                    <td>
                                        <input type="checkbox" name="toogle" value="{{ $seller->id }}"
                                            data-toggle="switchbutton" {{ $seller->status == 'active' ? 'checked' : '' }}
                                            data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                            data-onstyle="success" data-offstyle="danger">
                                    </td>
                                    <td>
                                        <a href="{{ route('seller.edit', $seller->id) }}" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"
                                            class="float-left btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('seller.destroy', $seller->id) }}" method="post"
                                            class="float-left ml-2">

                                            @method('delete')
                                            <a href=""data-id="{{ $seller->id }}" data-toggle="tooltip"
                                                title="delete" data-placement="bottom"
                                                class="dltBtn btn btn-sm btn-outline-danger">
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
                url: "{{ route('seller.status') }}",
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

       $('input[name= is_verified]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);

            $.ajax({
                url: "{{ route('seller.verified') }}",
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
