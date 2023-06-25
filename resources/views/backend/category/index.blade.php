@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                     <h2 >
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Categories
                        <a href="{{route('category.create')}}" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-plus"></i> Create Category</a>
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fa-regular fa-house"></i></a></li>
                        
                        <li class="breadcrumb-item active">Category</li>
                    </ul>
                    <p class="float-right">Total Categories :{{\App\Models\Category::count()}}</p>
                    </div>
            </div>
        </div>

             <div class="card-header py-3">
               
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
                                <th>Is parent</th>
                                <th>Parents </th>
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
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    {{-- <td>{!!html_entity_decode($item->summary)  !!}</td> --}}
                                    <td><img src="{{ $item->photo }}" alt="category image"
                                            style="max-height: 90px; max-width: 120px;"></td>
                                    <td>
                                        {{$item->is_parent ===1 ? 'Yes' : 'No'}}
                                       
                                    </td>
                                    <td>{{App\Models\Category::where('id',$item->parent_id)->value('title')}}</td>
                                    <td>
                                        <input type="checkbox" name="toogle" value="{{ $item->id }}"
                                            data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked' : '' }}
                                            data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                            data-onstyle="success" data-offstyle="danger">
                                        </td>
                                    <td>
                                        <a href="{{ route('category.edit', $item->id) }}" data-toggle="tooltip"
                                            title="edit" data-placement="bottom" class="float-left btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form  action="{{route('category.destroy',$item->id) }}" method="post" class="float-left ml-2">
                                            
                                            @method('delete')
                                            <a href=""data-id="{{$item->id}}" data-toggle="tooltip"  title="delete"
                                            data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger">
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
    {{-- Check Status --}}
    <script>
        $('input[name= toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);

            $.ajax({
                url: "{{ route('category.status') }}",
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
