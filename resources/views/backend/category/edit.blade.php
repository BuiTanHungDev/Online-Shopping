@extends('backend.layouts.index')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                     <h2 >
                        <a href="javasript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Category
                        
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fa-regular fa-house"></i></a></li>
                        <li class="breadcrumb-item "><a href="{{route('category.index')}}">Category </a></li>
                        <li class="breadcrumb-item active">Edit Category </li>
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
        <form action="{{route('category.update',$category->id)}}" method="post">
            @method('patch')
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Title <sup style="color: red">*</sup></label>
                            <input type="text" name="title" value="{{$category->title}}" class="form-control"
                                placeholder="Enter title">
                        </div>


                    </div>
                    


                </div>
                <div class="form-group" >
                    <label for="">Summary</label>
                    <textarea id="description" class="form-control" name="description" value="" placeholder="Write some text...">
                        {{$category->summary}}
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">Is parent :<sup class="text-danger">*</sup></label>
                    <input id="is_parent" type="checkbox" name="is_parent" value="1" {{$category->is_parent == 1 ? 'checked' : ''}}>Yes
                </div>
                <div class="form-group {{$category->is_parent == 1 ? 'd-none' : ''}}" id="parent_cat_div">
                    <label for="parent_id">Parent Category</label>
                    <select class="form-control show-tick" name="parent_id" id="">
                        <option value="">--Parent Categoty--</option>
                        @foreach ($parent_cats as $pcats )
                            <option value="{{$pcats->id}}"{{$pcats->id == $category->parent_id ? 'selected': '' }}>{{$pcats->title}}</option>
                            
                        @endforeach

                    </select>
                </div>


                <div class="form-group">
                    <label for="menu">Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="photo" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="photo" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px; width: 100px">
                      <img style="width: 100%;" src="{{$category->photo}}" alt="">
                    </div>  
                
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Update</button>
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

<script>
    $('#is_parent').change(function(e) {
        e.preventDefault();
        var is_checked= $('#is_parent').prop('checked');
        // alert(is_checked );

        if(is_checked) {
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        }
        else {
            $('#parent_cat_div').removeClass('d-none');
        }
    });
</script>
@endsection