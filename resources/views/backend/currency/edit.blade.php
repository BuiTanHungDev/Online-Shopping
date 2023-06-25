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
                                class="fa fa-arrow-left"></i></a>Currency

                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa-regular fa-house"></i></a>
                        </li>
                        <li class="breadcrumb-item "><a href="{{ route('currency.index') }}">Currency </a></li>
                        <li class="breadcrumb-item active">Edit Currency </li>
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
        <form action="{{ route('currency.update', $currency->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="menu">Curreny Name<sup style="color: red">*</sup></label>
                            <input type="text" name="name" value="{{ $currency->name }}" class="form-control"
                                placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Symbol<sup style="color: red">*</sup></label>
                            <input type="text" name="symbol" value="{{ $currency->symbol }}" class="form-control"
                                placeholder="symbol">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Exchange Rate<sup style="color: red">*</sup></label>
                            <input type="number" step="any" name="exchange_rate" value="{{ $currency->exchange_rate }}"
                                class="form-control" placeholder="exchange rate">

                        </div>
                    </div>

                </div>

                <div class="form-group ">
                    <label for="menu">Code<sup style="color: red">*</sup></label>
                    <input type="text" name="code" value="{{ $currency->code }}" class="form-control"
                        placeholder="Enter code">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!-- /.card-body -->


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
