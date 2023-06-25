@extends('backend.layouts.index')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a>Edit User

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="card-body">

                <div class="row clearfix">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group ">
                            <label for="full_name">Full Name<sup style="color: red">*</sup></label>
                            <input type="text" name="full_name" value="{{ $user->full_name }}" class="form-control"
                                placeholder="Full name">
                        </div>
                    </div>


                    {{-- <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="username">User Name<sup style="color: red">*</sup></label>
                            <input type="text" name="username" value="{{ $user->username }}" class="form-control"
                                placeholder="Enter user name">
                        </div>
                    </div> --}}
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="email">Email<sup style="color: red">*</sup></label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                placeholder="Email Address">
                        </div>
                    </div>
                
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="password">Phone<sup style="color: red">*</sup></label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"
                                placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="password">Address<sup style="color: red">*</sup></label>
                            <input type="" name="address" value="{{ $user->address }}" class="form-control"
                                placeholder="Enter address">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="menu">Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="photo" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="photo" class="form-control" type="text" name="photo"
                                    value=" {{ $user->photo }}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                <img style="width: 100px;" src=" {{ $user->photo }}" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group ">
                            <label for="">Role <span class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="role"
                                id="">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer
                              


                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="form-group ">
                            <label for="">Status</label>
                            <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="status"
                                id="">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                </div>






            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-secondary">Cancel</button>
            </div>

            @csrf
            <!--csrf Tạo token cho form -->
        </form>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
@section('footer')
    <Script>
        CKEDITOR.replace('description');
    </Script>
@endsection
