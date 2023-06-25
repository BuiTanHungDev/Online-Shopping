<div class="col-12 col-sm-6 col-md-4 col-lg-3"> 


    <div class="single-product-area mb-40 " style="margin-bottom: 40px">
        <div class="product_image" style="height: 235px;">
            @php
                $photo = explode(',', $product->photo);
            @endphp
            <!-- Product Image -->
            <img style="height: 100%;" class="first_img" src="{{ asset($photo[0]) }}" alt="{{ $product->title }}">
            <!-- Product Badge -->

            <div class="product_badge">
                <span>{{ $product->condition }}</span>
            </div>


            <!-- Wishlist -->
            <div class="product_wishlist">
                <a href="javascript:void(0);" id="add_to_wishlist{{ $product->id }}" class="add_to_wishlist"
                    data-quantity="1" data-id="{{ $product->id }}"><i class="icofont-heart"></i></a>
            </div>
            <!-- Compare -->
            <div class="product_compare">
                <a href="compare.html"><i class="icofont-exchange"></i></a>
            </div>
        </div>
        <!-- Product Description -->
        <div class="product_description">
            <!-- Add to cart -->
            <div class="product_add_to_cart">
                <a href="javascipt:void(0);" data-price="{{ $product->offer_price }}" class="add_to_cart"
                    data-quantity="1" id="add_to_cart{{ $product->id }}" data-product_id="{{ $product->id }}"><i
                        class="icofont-shopping-cart"></i> Add to Cart</a>
            </div>
            <!-- Quick View -->
            <div class="product_quick_view">
                <a href="#" data-toggle="modal" data-target="#quickview{{ $product->id }}"><i
                        class="icofont-eye-alt"></i> Quick View</a>
            </div>
            <p class="brand_name">
                {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
            <a href="{{ route('product.detail', $product->slug) }}">{{ ucfirst($product->title) }}</a>
            <h6 class="product-price">
                {{ \App\Utilities\Helpers::currency_converter($product->offer_price) }}
                <small><del class="text-danger">{{ \App\Utilities\Helpers::currency_converter($product->price) }}</del>
                </small>
            </h6>

        </div>
    </div>
    {{-- ------------------------ --}}

    <div class="modal fade" id="quickview{{ $product->id }}" tabindex="-1"
        style="background: rgba(0, 0, 0, 0.5);z-index: 100;" data-backdrop="false" aria-labelledby="quickview"
        aria-hidden="true" role="dialog" aria-labelledby="quickview">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn"style="font-size: 30px;" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        <!-- Product Image -->
                                        <img class="first_img" src="{{ asset($photo[0]) }}"
                                            alt="{{ $product->title }}">

                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">{{ $product->condition }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ ucfirst($product->title) }}</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h4 class="price mb-4">${{ number_format($product->offer_price, 2) }}
                                            <span>${{ number_format($product->price, 2) }}</span>
                                        </h4>
                                        <p>{!! html_entity_decode($product->summary) !!}</p>
                                        <a href="{{ route('product.detail', $product->slug) }}">View Full Product
                                            Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <div class="cart">
                                        <div class="quantity">
                                            <input type="number" data-id="{{ $product->id }}" class="qty-text"
                                                id="qty" step="1" min="1" max="12"
                                                name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" href="javascipt:void(0);"
                                            class="add_to_cart_button_details cart-submit"
                                            data-price="{{ $product->offer_price }}" data-quantity="1"
                                            id="add_to_cart_button_details_{{ $product->id }}"
                                            data-product_id="{{ $product->id }}" data-size="{{ $product->size }}"
                                            value="5">
                                            Add to cart
                                        </button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="javascript:void(0);" id="add_to_wishlist{{ $product->id }}"
                                                class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $product->id }}"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </div>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')

<script>
    $(document).ready(function() {
        if ($("#slider-range").length > 0) {
            const max_price = parseInt($("#slider-range").data('max')) || 700;
            const min_price = parseInt($('#slider-range').data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_price + '-' + max_price;

            if ($("#price_range").length > 0 && $("#price_range").val()) {
                price_range = $('#price_range').val().trim();
            }

            let price = price_range.split('-');
            $('#slider-range').slider({
                range: true,
                min: min_price,
                max: max_price,
                values: price,
                slide: function(event, ui) {
                    // $('#amount').val(currency + ui.values[0] + ' - ' + currency + ui.values[1]);
                    $('#amount').val(currency + ui.values[0] + ' - ' + currency + ui.values[1]);

                    $('#price_range').val(ui.values[0] + '-' + ui.values[1]);
                },
                change: function(event, ui) {
                    $('form#filter_form').submit();
                }
            });

            $('#amount').val(currency + price[0] + ' - ' + currency + price[1]);
        }
    });
</script>
    <script>
        $('.qty-text').on('change keyup', function() {
            var id = $(this).data('id');
            var spinner = $(this),
                input = spinner.closest('div.quantity').find('input[type="number"]');
            var newVal = parseFloat(input.val());
            $('#add_to_cart_button_details_' + id).attr('data-quantity', newVal);
        });

        $('.add_to_cart_button_details').on('click', function() {
            var product_qty = $(this).data('quantity');
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

            var product_id = <?php echo $product->id ?? 0; ?>;
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
@endsection

