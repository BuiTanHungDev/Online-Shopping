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
                                class="fa fa-arrow-left"></i></a>Edit Coupon

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupon</a></li>
                        <li class="breadcrumb-item active">Edit Coupon</li>
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
        <form action="{{ route('coupon.update',$coupon->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Coupon Code <sup style="color: red">*</sup></label>
                            <input type="text" name="code" value="{{$coupon->code}}" class="form-control"
                                placeholder="coupon code">
                        </div>
                        <div class="form-group ">
                            <label for="menu">Coupon Value <sup style="color: red">*</sup></label>
                            <input type="text" name="value" value="{{$coupon->value}}" class="form-control"
                                placeholder="Coupon value">
                        </div>


                    </div>



                </div>

                
                <div class="form-group ">
                    <label for="">Type</label>
                    <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="type" id="">
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent </option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="">Status</label>
                    <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="status" id="">
                        <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $coupon->status== 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="submit" class="btn btn-secondary">Cancel</button>
            </div>

            
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
