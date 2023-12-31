@extends('frontend.layouts.master')

@section('content')
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                            quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium
                                            eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1"
                                                min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                            cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
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
    <!-- Quick View Modal Area -->

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop Grid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <form action="{{ route('shop.filter') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-12 col-sm-5 col-md-4 col-lg-3">

                        <div class="shop_sidebar_area">

                            @if (count($categories) > 0)
                                <div class="widget catagory mb-30">
                                    <h6 class="widget-title">Product Categories</h6>
                                    <div class="widget-desc">
                                        @if (!empty($_GET['category']))
                                            @php
                                                $filter_cats = explode(',', $_GET['category']);
                                            @endphp
                                        @endif
                                        @foreach ($categories as $cat)
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="{{ $cat->slug }}"@if (!empty($filter_cats) && in_array($cat->slug, $filter_cats)) checked @endif
                                                    name="category[]" onchange="this.form.submit()"
                                                    value="{{ $cat->slug }}">
                                                <label class="custom-control-label"
                                                    for="{{ $cat->slug }}">{{ ucfirst($cat->title) }}<span
                                                        class="text-muted">({{ count($cat->products) }})</span></label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif
                            <!-- Single Widget -->


                            <!-- Single Widget -->
                            <div class="widget price mb-30">
                                <h6 class="widget-title">Filter by Price</h6>
                                <div class="widget-desc">
                                    {{-- <div class="slider-range">
                                        <div id="slider-range" data-min="{{ \App\Utilities\Helpers::minPrice() }}"
                                            data-max="{{ \App\Utilities\Helpers::maxPrice() }}" data-unit="$"
                                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                            data-value-min="{{ \App\Utilities\Helpers::minPrice() }}"
                                            data-value-max="{{ \App\Utilities\Helpers::maxPrice() }}"
                                            data-label-result="Price:">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                        </div>

                                        <div class="d-flex mt-2 ">
                                            @if (!empty($_GET['price']))
                                                @php
                                                    $price = explode('-', $_GET['price']);
                                                @endphp
                                            @endif
                                            <input type="hidden" id="price_range" name="price_range"
                                                value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif">
                                            <input style="border: none;width: 50%" type="text"
                                                value="@if (!empty($_GET['price'])) {{ $price[0] }} @else ${{ \App\Utilities\Helpers::minPrice() }} @endif -  @if (!empty($_GET['price'])) {{ $price[1] }} @else ${{ \App\Utilities\Helpers::maxPrice() }} @endif"
                                                readonly name="" id="amount">

                                            <div class="range-price">Price:  ${!! \App\Utilities\Helpers::minPrice() !!} - ${!! \App\Utilities\Helpers::maxPrice()!!}</div>
                                            <button type="submit" class="btn btn-sm btn-primary float-right"
                                                style="margin: 12px 0 12px 18px; height: 30px;line-height: 30px">Filter</button>
                                        </div>

                                      
                                    </div> --}}

                                    <div class="slider-range">
                                        <div id="slider-range" data-min="{{ \App\Utilities\Helpers::minPrice() }}"
                                            data-max="{{ \App\Utilities\Helpers::maxPrice() }}" data-currency="$"
                                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                            data-value-min="{{ \App\Utilities\Helpers::minPrice() }}"
                                            data-value-max="{{ \App\Utilities\Helpers::maxPrice() }}"
                                            data-label-result="Price:">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                        </div>

                                        <div class="d-flex mt-2">
                                            @if (!empty($_GET['price']))
                                                @php
                                                    $price = explode('-', $_GET['price']);
                                                @endphp
                                            @endif
                                            <input type="hidden" id="price_range" name="price_range"
                                                value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif">
                                            <input style="border: none;width: 50%" type="text"
                                                value="@if (!empty($_GET['price'])) {{ $price[0] }}@else{{ \App\Utilities\Helpers::minPrice() }} @endif - @if (!empty($_GET['price'])) {{ $price[1] }}@else{{ \App\Utilities\Helpers::maxPrice() }} @endif"
                                                readonly name="" id="amount">

                                            <button type="submit" class="btn btn-sm btn-primary float-right"
                                                style="margin: 12px 0 12px 18px; height: 30px;line-height: 30px">Filter</button>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget color mb-30">
                                <h6 class="widget-title">Filter by Color</h6>
                                <div class="widget-desc">
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck6">
                                        <label class="custom-control-label black" for="customCheck6">Black <span
                                                class="text-muted">(9)</span></label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck7">
                                        <label class="custom-control-label pink" for="customCheck7">Pink <span
                                                class="text-muted">(6)</span></label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck8">
                                        <label class="custom-control-label red" for="customCheck8">Red <span
                                                class="text-muted">(8)</span></label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                                        <label class="custom-control-label purple" for="customCheck9">Purple <span
                                                class="text-muted">(4)</span></label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="customCheck10">
                                        <label class="custom-control-label orange" for="customCheck10">Orange <span
                                                class="text-muted">(7)</span></label>
                                    </div>
                                </div>
                            </div>
                            @if (count($brands) > 0)
                                <!-- Single Widget -->
                                <div class="widget brands mb-30">
                                    <h6 class="widget-title">Filter by brands</h6>
                                    <div class="widget-desc">
                                        @if (!empty($_GET['brand']))
                                            @php
                                                $filter_brands = explode(',', $_GET['brand']);
                                            @endphp
                                        @endif
                                        @foreach ($brands as $brand)
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input"
                                                    @if (!empty($filter_brands) && in_array($brand->slug, $filter_brands)) checked @endif
                                                    id="{{ $brand->slug }}" name="brand[]" value="{{ $brand->slug }}"
                                                    onchange="this.form.submit();">
                                                <label class="custom-control-label"
                                                    for="{{ $brand->slug }}">{{ $brand->title }}<span
                                                        class="text-muted">({{ count($brand->products) }})</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <!-- Single Widget -->
                            <div class="widget rating mb-30">
                                <h6 class="widget-title">Average Rating</h6>
                                <div class="widget-desc">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i> <span
                                                    class="text-muted">(103)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(78)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(47)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(9)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(3)</span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget size mb-30">
                                <h6 class="widget-title">Filter by Size</h6>
                                <div class="widget-desc">
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '35') checked @endif name="size"
                                            value="35" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck11">35<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '35'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck12"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '36') checked @endif name="size"
                                            value="36" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck12">36<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '36'])->count() }})</span></label>
                                    </div>

                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck13"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '37') checked @endif name="size"
                                            value="37" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck13">37<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '37'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck14"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '38') checked @endif name="size"
                                            value="38" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck14">38<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '38'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck15"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '39') checked @endif name="size"
                                            value="39" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck15">39<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '39'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck16"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '40') checked @endif name="size"
                                            value="40" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck16">40<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '40'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck17"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '41') checked @endif name="size"
                                            value="41" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck17">41<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '41'])->count() }})</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck18"
                                            @if (!empty($_GET['size']) && $_GET['size'] == '42') checked @endif name="size"
                                            value="42" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="customCheck18">42<span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => '42'])->count() }})</span></label>
                                    </div>





                                    {{-- <ul>
                                        <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li>
                                    </ul> --}}
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                        <!-- Shop Top Sidebar -->
                        <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                            <div class="view_area d-flex">
                                <div class="grid_view">
                                    <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                        title="Grid View"><i class="icofont-layout"></i></a>
                                </div>
                                <div class="list_view ml-3">
                                    <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                        title="List View"><i class="icofont-listine-dots"></i></a>
                                </div>
                            </div>
                            <select onchange="this.form.submit();" id="sortBy" class="small right" name="sortBy">
                                <option value=""> Default Sort</option>
                                <option value="priceAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif>Price - Lower
                                    To
                                    Higher</option>
                                <option value="priceDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif>Price -
                                    Higher
                                    To Lower</option>
                                <option value="titleAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif>Alphabetical
                                    Ascending</option>
                                <option value="titleDesc"@if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif>Alphabetical
                                    Descending</option>
                                <option value="discountAsc"@if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discountAsc') selected @endif>Discount
                                    -
                                    Lower To Higher</option>
                                <option value="discountDesc"@if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discountDesc') selected @endif>
                                    Discount -
                                    Higher To Lower</option>


                            </select>
                        </div>

                        <div class="shop_grid_product_area">

                            <p>Total products : {{ $products->total() }}</p>
                            <div class="row ">
                                <!-- Single Product -->


                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                    
                                        @include('frontend.layouts._single-product',['product'=>$product])

                                    @endforeach
                                @else
                                    <p> No product found ! </p>
                                @endif
                            </div>
                        </div>
                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}



                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection



@section('scripts')
    {{-- filter prices --}}
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


    {{-- End filter price --}}

    {{-- add to cart --}}
    <script>
        // Add to cart
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product_id');
            var product_qty = $(this).data('quantity');
            var path = "{{ route('cart.store') }}";
            var token = "{{ csrf_token() }}";

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
    {{-- End add to cart  --}}
@endsection
