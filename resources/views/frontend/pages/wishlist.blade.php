@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div id="wishlist_container">
        <div class="wishlist-table section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table wishlist-table">
                            <div class="table-responsive" id="wishlist_list">
                                @include('frontend.layouts._wishlist')
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->
@endsection

@section('scripts')
    {{-- add wishlist --}}
    <script>
        $(document).on('click', '.move-to-cart', function(e) {
        e.preventDefault();
        var rowId = $(this).data('id');
        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.move.cart') }}";

        var addToCartButton = $(this); // Lưu trữ tham chiếu đến nút "Add to Cart"

        $.ajax({
            url: path,
            type: "POST",
            data: {
                _token: token,
                rowId: rowId,
            },
            beforeSend: function() {
                addToCartButton.html('<i class="fas fa-spinner fa-spin"></i> Moving to cart');
            },
            success: function(data) {
                if (data.status) {
                    var cartCounter = $('#cart_counter');
                    var wishlistCounter= $('#wishlist_counter');
                    wishlistCounter.html(data.wishlist_count);
                    cartCounter.html(data.cart_count); // Cập nhật số lượng giỏ hàng
                    $('#wishlist_list').html(data.wishlist_list); //
                    swal({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        button: "OK",
                    });
                    

                    // Cập nhật số lượng giỏ hàng trong header
                    var headerCartCounter = $('body #cart-counter');
                    if (headerCartCounter.length > 0) {
                        headerCartCounter.html(data.cart_count);
                    }
                    
                } else {
                    swal({
                        title: "Something went wrong",
                        text: data.message,
                        icon: "warning",
                        button: "OK",
                    });
                }
            },
            error: function() {
                swal({
                    title: "Error",
                    text: "Something went wrong",
                    icon: "error",
                    button: "OK",
                });
            },
            complete: function() {
                addToCartButton.html('Add to Cart');
            }
        });
        });
   
    </script> 
{{-- đã ok --}}
    {{-- end add wishlist --}}


    {{-- delete wishlist --}}
    <script>
        $('.delete_wishlist').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            alert(rowId);

        });
    </script>
@endsection
