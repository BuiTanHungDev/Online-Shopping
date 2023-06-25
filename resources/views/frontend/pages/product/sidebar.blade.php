<div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <form action="{{route('shop.filter')}}" method="post">
        @csrf
        <div class="shop_sidebar_area">

            @if (count($categories) > 0)
                <div class="widget catagory mb-30">
                    <h6 class="widget-title">Product Categories</h6>
                    <div class="widget-desc">
                        @if (!empty($_GET['category']))
                            @php
                                $filter_cats = explode(',',$_GET['category']);
                            @endphp
                            
                        @endif
                        @foreach ($categories as $cat)
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" class="custom-control-input"
                                    id="{{ $cat->slug }}"@if(!empty($filter_cats) && in_array($cat->slug,$filter_cats)) checked @endif name="category[]" onchange="this.form.submit()" value="{{$cat->slug}}">
                                <label class="custom-control-label"
                                    for="{{ $cat->slug }}">{{ ucfirst($cat->title) }}<span
                                        class="text-muted">({{ count($cat->products) }})</span></label>
                            </div>
                        @endforeach
                        <!-- Single Checkbox -->

                        <!-- Single Checkbox -->
                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Women <span
                                    class="text-muted">(67)</span></label>
                        </div>
                        <!-- Single Checkbox -->
                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                            <label class="custom-control-label" for="customCheck3">Kids <span
                                    class="text-muted">(89)</span></label>
                        </div>
                        <!-- Single Checkbox -->
                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                            <label class="custom-control-label" for="customCheck4">Accessories <span
                                    class="text-muted">(425)</span></label>
                        </div>
                        <!-- Single Checkbox -->
                        <div class="custom-control custom-checkbox d-flex align-items-center">
                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                            <label class="custom-control-label" for="customCheck5">Fashion <span
                                    class="text-muted">(73)</span></label>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Single Widget -->


            <!-- Single Widget -->
            <div class="widget price mb-30">
                <h6 class="widget-title">Filter by Price</h6>
                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="0" data-max="1350" data-unit="$"
                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                            data-value-min="0" data-value-max="1350" data-label-result="Price:">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                tabindex="0"></span>
                        </div>
                        <div class="range-price">Price: 0 - 1350</div>
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

            <!-- Single Widget -->
            <div class="widget brands mb-30">
                <h6 class="widget-title">Filter by brands</h6>
                <div class="widget-desc">
                    <!-- Single Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                        <label class="custom-control-label" for="customCheck11">Zara <span
                                class="text-muted">(213)</span></label>
                    </div>
                    <!-- Single Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck12">
                        <label class="custom-control-label" for="customCheck12">Gucci <span
                                class="text-muted">(65)</span></label>
                    </div>
                    <!-- Single Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck13">
                        <label class="custom-control-label" for="customCheck13">Addidas <span
                                class="text-muted">(70)</span></label>
                    </div>
                    <!-- Single Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck14">
                        <label class="custom-control-label" for="customCheck14">Nike <span
                                class="text-muted">(104)</span></label>
                    </div>
                    <!-- Single Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center">
                        <input type="checkbox" class="custom-control-input" id="customCheck15">
                        <label class="custom-control-label" for="customCheck15">Denim <span
                                class="text-muted">(71)</span></label>
                    </div>
                </div>
            </div>

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
                    <ul>
                        <li><a href="#">XS</a></li>
                        <li><a href="#">S</a></li>
                        <li><a href="#">M</a></li>
                        <li><a href="#">L</a></li>
                        <li><a href="#">XL</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>

</div>