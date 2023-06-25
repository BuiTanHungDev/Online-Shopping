<!doctype html>
<html lang="en">

<head>
    @include('frontend.layouts.head')

</head>

<body>
    <!-- Preloader -->
    {{-- <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
  
    {{-- main --}}

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')


    @include('frontend.layouts.scripts')



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- Cart Delete --}}
    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";

            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success: function(data) {
                    console.log(data);

                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "ok",
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>
{{--End cart delete  --}}
{{-- auto search --}}
    <script>
        $(document).ready(function(){
            var path= "{{route('autoSearch')}}";
            $('#search_text').autocomplete({
                source: function(request, response){
                    $.ajax({
                        url:path,
                        dataType:"JSON",
                        data:{
                            term:request.term
                        },
                        success:function(data){
                            response(data);
                        }
                    });

                },
                minLength:1,
                 
            });
        });
    </script>
{{-- end auto Search --}}
{{-- Currecy --}}

<script>
   function currency_change(currency_code){
        $.ajax({
            type:'post',
            url:'{{route('currency.load')}}',
            data:{
                currency_code: currency_code,
                _token:'{{csrf_token()}}',

            },
            success:function(response){
                if(response['status']){
                    location.reload();
                }
                else{
                    alert(' Server error')
                }
            }
        });

    }  
</script>

{{-- add to cart --}}
<script>
    $(document).on('click', '.add_to_cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product_id');
        var product_qty = $(this).data('quantity');
        var product_price= $(this).data('price');
        var path = "{{ route('cart.store') }}";
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                product_qty: product_qty,
                product_price:product_price,
                _token: token,
            },
            beforeSend: function() {
                $('#add_to_cart' + product_id).html(
                    '<i class="fa fa-spinner fa-spin"></i>loading...');
            },
            complete: function() {
                $('#add_to_cart' + product_id).html(
                    '<i class="icofont-shopping-cart"></i> Add to Cart');
            },
            success: function(data) {
                console.log(data);
                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "OK",
                    });
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>

{{-- add to wishlist --}}

<script>
    $(document).on('click', '.add_to_wishlist', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_qty = $(this).data('quantity');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.store') }}";

        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend: function() {
                $('#add_to_wishlist' + product_id).html(
                    '<i class="fa fa-spinner fa-spin"></i>loading...');
            },
            complete: function() {
                $('#add_to_wishlist' + product_id).html('<i class="icofont-heart-alt"></i>');
            },
            success: function(data) {
                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "ok",
                    })
                } else if (data['present']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    swal({
                        title: "Opps!",
                        text: data['message'],
                        icon: "warning",
                        button: "ok",
                    })
                } else {

                    swal({
                        title: "Sory!",
                        text: data['message'],
                        icon: "error",
                        button: "ok",
                    })
                }
            },
            error: function(err) {
                console.log(err);
            }
        });

    });

</script>
{{-- ------------- --}}
{{-- add product details --}}
<script>
    $('.add_to_cart_button_details').on('click', function() {
        var product_qty = $(this).closest('form.cart').find('.qty-text').val();
        var product_id = $(this).data('product_id');
        var product_size = $(this).data('size');
        var product_price = $(this).data('price');
        var token = "{{ csrf_token() }}";
        var path = "{{ route('cart.store') }}";

        $.ajax({
            url: path,
            type: "POST",
            data: {
                _token: token,
                product_id: product_id,
                product_size: product_size,
                product_price: product_price,
                product_qty: product_qty,
            },
            beforeSend: function() {
                $('#add_to_cart_button_details_' + product_id).html(
                    '<i class="fas fa-spinner fa-spin"></i>Loading...');
            },
            complete: function() {
                $('#add_to_cart_button_details_' + product_id).html('Add To Cart');
            },
            success: function(data) {
                $('body #header-ajax').html(data['header']);
                $('body #cart-counter').html(data['cart_count']);

                swal({
                    title: "Good job!",
                    text: data['message'],
                    icon: "success",
                    button: "OK",
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>






<script>
    $('#size').change(function() {
        var size = $(this).val();
        $('.add_to_cart_button_details').attr('data-size', size);

        var product_id = "{{ $product->id ?? 0 }}";
        if (product_id != 0) {
            $.ajax({
                url: '/get-product-price/' + product_id,
                data: {
                    size: size
                },
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        var data = response.data;
                        $('#original_price').html('$' + data['original_price']);
                        $('#offer_price').html('$' + data['offer_price']);
                        $('#add_to_cart_button_details_' + product_id).attr('data-price', data[
                            'offer_price']);
                    }
                }
            });
        }
    });
</script>
</body>

</html>
