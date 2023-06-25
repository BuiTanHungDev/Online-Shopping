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
                                class="fa fa-arrow-left"></i></a>Add User

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
        <form action="{{ route('user.store') }}" method="post">
            <div class="card-body">

                <div class="row clearfix">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group ">
                            <label for="full_name">Full Name<sup style="color: red">*</sup></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control"
                                placeholder="Full name">
                        </div>
                    </div>


                    {{-- <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="username">User Name<sup style="color: red">*</sup></label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                placeholder="Enter user name">
                        </div>
                    </div> --}}
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="email">Email<sup style="color: red">*</sup></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Email Address">
                        </div>
                    </div>
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="password">Password<sup style="color: red">*</sup></label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="password">Phone<sup style="color: red">*</sup></label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="col-md-12  col-lg-12">
                        <div class="form-group ">
                            <label for="password">Address<sup style="color: red">*</sup></label>
                            <input type="" name="address" value="{{ old('address') }}" class="form-control"
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
                                <input id="photo" class="form-control" type="text" name="photo" value=" {{old('photo')}}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                             <img style="width: 100px;" src="{{old('photo')}}" alt=""> 
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group ">
                            <label for="">Role <span class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="role"
                                id="">
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                
                                <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                <option value="customer" {{ old('role') == 'custumer' ? 'selected' : '' }}>Customer</option>

                                
                            </select>
                        </div>
                    </div>



                </div>







                {{-- <div class="form-group">
                    <label for="menu">Sort by</label>
                    <input type="number" name="sort_by" value="1" class="form-control" id="">
                </div> --}}

                <div class="form-group ">
                    <label for="">Status</label>
                    <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="status" id="">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
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
