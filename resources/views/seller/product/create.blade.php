@extends('seller.layouts.index')
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
                                class="fa fa-arrow-left"></i></a>Add Product

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('seller-product.index') }}">Product</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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
        <form action="{{ route('seller-product.store') }}" method="post">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="title">Title <sup style="color: red">*</sup></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                placeholder="Enter title">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="menu">Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="photo" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="photo" class="form-control" type="text" name="photo">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;">

                    </div>

                </div>
                <div class="form-group">
                    <label for="menu">Size Guide</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm1" data-input="photo1" data-preview="holder1" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="photo1" class="form-control" type="text" name="size_guide">
                    </div>
                    <div id="holder1" style="margin-top:15px;max-height:100px;">

                    </div>
                </div>

                <div class="form-group">
                    <label for="">Summary</label>
                    <textarea id="summary" class="form-control" name="summary" value="" placeholder="Write some text...">
                        {{ old('summary') }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea id="description" class="form-control" name="description" value="" placeholder="Write some text...">
                        {{ old('description') }}
                    </textarea>
                </div>
                <div class="form-group ">
                    <label for="stock">Stock <sup style="color: red">*</sup></label>
                    <input type="number" name="stock" value="{{ old('stock') }}" class="form-control"
                        placeholder="stock">
                </div>
                <div class="form-group ">
                    <label for="price">Price<sup style="color: red">*</sup></label>
                    <input type="number" name="price" value="{{ old('price') }}" class="form-control"
                        placeholder="Enter price">
                </div>
                <div class="form-group ">
                    <label for="discount">Discount<sup style="color: red">*</sup></label>
                    <input type="number" min="0" max="100" name="discount" value="{{ old('discount') }}"
                        class="form-control" placeholder="Enter discount">
                </div>
                <div class="form-group ">
                    <label for="">Condition</label>
                    <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="condition" id="">
                        <option value="">--Condition--</option>
                        <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>Popular </option>
                        <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>Winter </option>

                    </select>
                </div>
                <div class="form-group  ">
                    <label for="">Brands</label>
                    <select class="form-control custom-radio col-lg-12 col-md-12 col-sm-12" name="brand_id" id="">
                        <option value="">---Brands---</option>
                        @foreach (\App\Models\Brand::get() as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ ucfirst($brand->title) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ">
                    <label for="">Category</label>
                    <select class="form-control show-tick custom-radio col-lg-3 col-md-6 col-sm-12" name="cat_id"
                        id="cat_id">
                        <option value="">--- Category ---</option>
                        @foreach (\App\Models\Category::where('is_parent', 1)->get() as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                {{ ucfirst($cat->title) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-none" id="child_cat_div">
                    <label for="">Child Category</label>
                    <select class="form-control show-tick custom-radio col-lg-3 col-md-6 col-sm-12" name="child_cat_id"
                        id="child_cat_id">
                        <option value="">--- Child Category ---</option>

                    </select>
                </div>
                <div class="form-group ">
                    <label for="">Size</label>
                    <select class="form-control custom-radio col-lg-3 col-md-6 col-sm-12" name="size">
                        <option value="">--- Size ---</option>
                        <option value="35" {{ old('size') == '35' ? 'selected' : '' }}>35</option>
                        <option value="36"{{ old('size') == '36' ? 'selected' : '' }}>36</option>
                        <option value="37"{{ old('size') == '37' ? 'selected' : '' }}>37</option>
                        <option value="38"{{ old('size') == '38' ? 'selected' : '' }}>38</option>
                        <option value="39"{{ old('size') == '39' ? 'selected' : '' }}>39</option>
                        <option value="40"{{ old('size') == '40' ? 'selected' : '' }}>40</option>
                        <option value="41"{{ old('size') == '41' ? 'selected' : '' }}>41</option>
                        <option value="42"{{ old('size') == '42' ? 'selected' : '' }}>42</option>

                    </select>
                </div>

                {{-- <div class="form-group  ">
                    <label for="">Added By</label>
                    <select class="form-control custom-radio col-lg-12 col-md-12 col-sm-12" name="vendor_id"
                        id="">
                        <option value="">---Vendors---</option>
                        @foreach (\App\Models\User::where('role', 'vendor')->get() as $vendor)
                            <option value="{{ $vendor->id }}" {{ old('vendor') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->full_name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="">Additional information</label>
                    <textarea id="description" class="form-control description" name="additional_info" value="" placeholder="Write some text...">
                        {{ old('additional_info') }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for=""> Return & Cancellation</label>
                    <textarea id="description" class="form-control description" name="return_cancellation" value="" placeholder="Write some text...">
                        {{ old('return_cancellation') }}
                    </textarea>
                </div>
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


            <!--csrf Tạo token cho form -->
        </form>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm,#lfm1').filemanager('image');
    </script>
   
     <script>
        $(document).ready(function(){
            $('.description').summernote();
        });
    </script>
@endsection
@section('footer')
    <Script>
        CKEDITOR.replace('description');
    </Script>
    <Script>
        CKEDITOR.replace('additional_info');
    </Script>
    <Script>
        CKEDITOR.replace('return_cancellation');
    </Script>
    <Script>
        CKEDITOR.replace('summary');
    </Script>
    <Script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            //  alert(cat_id);
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''>---Child Category---</option>";
                        if (response.status) {

                            $('#child_cat_div').removeClass('d-none');

                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title +
                                    "</option>";

                            });

                            // $('#child_cat_id').html(html_option);
                        } else {
                            $('#child_cat_div').removeClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            }
        });
    </Script>
@endsection
