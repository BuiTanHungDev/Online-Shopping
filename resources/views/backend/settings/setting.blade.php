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
                                class="fa fa-arrow-left"></i></a>Edit Setting

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            
                @include('backend.layouts.notification')
            
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
        <form action="{{ route('settings.store') }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Shop Name<sup style="color: red">*</sup></label>
                            <input type="text" name="title" value="{{ $settings->title }}" class="form-control"
                                placeholder="Enter name">
                        </div>


                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Meta Keywork<sup style="color: red">*</sup></label>
                            <input type="text" name="meta_keywords" value="{{ $settings->meta_keywords }}" class="form-control"
                                placeholder="Enter meta keywords">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Meta Description</label>
                            <textarea id="description" rows="5" class="form-control" name="meta_description" value=""
                                placeholder="Write some text...">
                        {{ $settings->meta_description }}</textarea>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Logo</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="photo" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="photo" class="form-control" type="text" name="logo"
                                    value="{{ $settings->logo }}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                <img style="width: 100%;" src="{{ $settings->logo }}" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="menu">Favicon</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="favi" data-input="favicon" data-preview="holder1" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="favicon" class="form-control" type="text" name="favicon"
                                    value="{{ $settings->favicon }}">
                            </div>
                            <div id="holder1" style="margin-top:15px;max-height:100px;">
                                <img style="width: 100%;" src="{{ $settings->favicon }}" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Email<sup style="color: red">*</sup></label>
                            <input type="text" name="email" value="{{ $settings->email }}" class="form-control"
                                placeholder="Enter email">
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Phone<sup style="color: red">*</sup></label>
                            <input type="number" name="phone" value="{{ $settings->phone }}" class="form-control"
                                placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="  col-md-12">
                        <div class="form-group ">
                            <label for="menu">Address<sup style="color: red">*</sup></label>
                            <input type="text" name="address" value="{{ $settings->address }}" class="form-control"
                                placeholder="Enter address">
                        </div>
                    </div>


                    <div class="col-md-12">
                         <div class="form-group ">
                    <label for="menu">footer<sup style="color: red">*</sup></label>
                    <input type="text" name="footer" value="{{ $settings->footer }}" class="form-control"
                        placeholder="Enter footer">
                </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Fakebook URL<sup style="color: red">*</sup></label>
                            <input type="text" name="facebook_url" value="{{ $settings->facebook_url }}"
                                class="form-control" placeholder="Enter facebook_url">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Twitrer URL<sup style="color: red">*</sup></label>
                            <input type="text" name="twitter_url" value="{{ $settings->twitter_url }}" class="form-control"
                                placeholder="Enter twitter_url">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Google URL<sup style="color: red">*</sup></label>
                            <input type="text" name="google_url" value="{{ $settings->google_url }}" class="form-control"
                                placeholder="Enter google_url">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label for="menu">Instagram URL<sup style="color: red">*</sup></label>
                            <input type="text" name="instagram_url" value="{{ $settings->instagram_url }}"
                                class="form-control" placeholder="Enter instagram_url">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Printerest<sup style="color: red">*</sup></label>
                            <input type="text" name="printerest" value="{{ $settings->printerest }}" class="form-control"
                                placeholder="Enter printerest">
                        </div>
                    </div>

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
        $('#lfm,#favi').filemanager('image');
    </script>
@endsection
@section('footer')
    <Script>
        CKEDITOR.replace('description');
    </Script>
@endsection
