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
                                class="fa fa-arrow-left"></i></a>Add Brand

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brand</a></li>
                        <li class="breadcrumb-item active">Add Brand</li>
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
        <form action="{{route('brand.store')}}" method="post">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Title <sup style="color: red">*</sup></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                placeholder="Enter title">
                        </div>


                    </div>


                </div>
                {{-- <div class="form-group" >
                    <label for="">Description</label>
                    <textarea id="description" class="form-control" name="description" value="" placeholder="Write some text...">
                        {{old('description')}}
                </textarea>
                </div> --}}
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