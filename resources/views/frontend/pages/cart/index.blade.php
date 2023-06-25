@extends('frontend.layouts.master')

@section('content')
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between" id="cart_list">
                 @include('frontend.layouts._cart-list')
                
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection


@section('scripts')
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

    {{-- Tính tiền sản phẩm click tăng giảm  --}}


    {{-- <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            var spinner = $(this);
            var input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() == 1) {

                return false;
            }

            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                input.val(newVal);

                var productQuantity = $("#update-cart-" + id).data('product-quantity');
                update_Cart(id, productQuantity, newVal); // Truyền thêm tham số newVal vào hàm update_Cart
            }
        });

        function update_Cart(id, productQuantity, newVal) {
            var rowId = id;
            var product_qty = $('.qty-text[data-id="' + rowId + '"]').val();
            var token = "{{ csrf_token() }}";
            var part = "{{ route('cart.update') }}";

            $.ajax({
                url: part,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                },
                success: function(data) {
                    console.log(data);
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);

                        // Cập nhật số lượng sản phẩm trực tiếp trên giao diện
                        var quantityInput = $('input[data-id="' + rowId + '"]');
                        quantityInput.val(newVal);

                        // Cập nhật giá tiền của sản phẩm
                        updatePriceOnInterface(rowId, data['price']);

                        // Cập nhật tổng số trực tiếp trên giao diện
                        updateTotalOnInterface(data['total']);

                        // swal({
                        //     title: "Good job!",
                        //     text: data['message'],
                        //     icon: "success",
                        //     button: "ok",
                        // });
                    } else {
                        alert(data['message'])
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function updatePriceOnInterface(rowId, price) {
            var priceElement = $('#price-' + rowId);
            priceElement.text(price);
        }

        function updateTotalOnInterface(total) {
            var totalElement = $('#total'); // Thay thế 'total' bằng ID của phần tử tổng số trên giao diện
            totalElement.text(total);
        }
    </script> --}}
    {{-- <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            var spinner = $(this);
            var input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() <= 1) {
                var productPrice = input.data('initial-price');
                updatePriceOnInterface(id, productPrice);
                updateQuantityOnInterface(id, 1);
                updateTotalOnInterface();
                updateCart(id, 1);
                return false;
            }

            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                input.val(newVal);

                var productQuantity = $("#update-cart-" + id).data('product-quantity');
                updateCart(id, productQuantity, newVal);
            }
        });
        

        function updateCart(id, productQuantity, newVal) {
            var rowId = id;
            var product_qty = $('.qty-text[data-id="' + rowId + '"]').val();
            var token = "{{ csrf_token() }}";
            var part = "{{ route('cart.update') }}";

            $.ajax({
                url: part,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                },
                success: function(data) {
                    console.log(data);
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);

                        updateQuantityOnInterface(rowId, newVal);
                        updatePriceOnInterface(rowId, data['price']);
                        updateTotalOnInterface(data['total']);
                    } else {
                        alert(data['message'])
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function updatePriceOnInterface(rowId, price) {
            var priceElement = $('#price-' + rowId);
            priceElement.text(price);
        }

        function updateQuantityOnInterface(rowId, quantity) {
            var quantityInput = $('input[data-id="' + rowId + '"]');
            quantityInput.val(quantity);
        }

        function updateTotalOnInterface(total) {
            var total = 0;
            $('.qty-text').each(function() {
                var id = $(this).data('id');
                var quantity = parseFloat($(this).val());
                var price = parseFloat($('#price-' + id).text());
                var subtotal = quantity * price;
                total += subtotal;
            });
            var totalElement = $('#total');
            totalElement.text(total.toFixed(2));
        }
    </script> --}}

    <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            var spinner = $(this);
            var input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() <= 1) {
                var productPrice = input.data('initial-price');
                updatePriceOnInterface(id, productPrice);
                updateQuantityOnInterface(id, 1);
                updateTotalOnInterface();
                updateCart(id, 1);
                return false;
            }

            var newVal = parseFloat(input.val());
            input.val(newVal);

            var productQuantity = $("#update-cart-" + id).data('product-quantity');
            updateCart(id, productQuantity, newVal);
        });






        function updateQuantityOnInterface(rowId, quantity) {
            var quantityInput = $('input[data-id="' + rowId + '"]');
            if (quantity < 1) {
                quantity = 1; // Đảm bảo số lượng không nhỏ hơn 1
            }
            quantityInput.val(quantity);
        }


        function updateCart(id, productQuantity, newVal) {
            var rowId = id;
            var product_qty = $('.qty-text[data-id="' + rowId + '"]').val();
            var token = "{{ csrf_token() }}";
            var part = "{{ route('cart.update') }}";

            $.ajax({
                url: part,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                },
                success: function(data) {
                    console.log(data);
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);

                        updateQuantityOnInterface(rowId, newVal);
                        updatePriceOnInterface(rowId, data['price']);
                        updateTotalOnInterface(data['total']);
                    } else {
                        alert(data['message'])
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function updatePriceOnInterface(rowId, price) {
            var priceElement = $('#price-' + rowId);
            priceElement.text(price);
        }

        function updateTotalOnInterface(total) {
            var total = 0;
            $('.qty-text').each(function() {
                var id = $(this).data('id');
                var quantity = parseFloat($(this).val());
                var price = parseFloat($('#price-' + id).text());
                var subtotal = quantity * price;
                total += subtotal;
            });
            var totalElement = $('#total');
            totalElement.text(total.toFixed(2));
        }
    </script>





    {{-- end Cart --}}

    {{-- coupon --}}
    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name="code"]').val();
            $('.coupon-btn').html('<i class="fas fa-spinner fa-spin"></i>Applying...');
            $('#coupon-form').submit();
        });
    </script>
@endsection
