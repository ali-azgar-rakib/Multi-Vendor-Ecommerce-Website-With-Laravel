@extends('frontend.layout.frontend_master')

@section('frontend')
<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">{{ $category->name }}</h1>
                    <div class="breadcrumb">
                        <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop <span></span> {{ $category->name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ $products->count() }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">

                @foreach ($products as $product)

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a
                                    href="{{ route('product_details',['product' => $product->id,'slug' => $product->product_slug]) }}">
                                    <img class="default-img"
                                        src="{{ file_exists(public_path('uploaded/product/'.$product->thumbnail)) ? asset('uploaded/product/'.$product->thumbnail) : asset('uploaded/no_image.jpg')  }}"
                                        alt="" />
                                    <img class="hover-img"
                                        src="{{ file_exists(public_path('uploaded/product/'.$product->thumbnail)) ? asset('uploaded/product/'.$product->thumbnail) : asset('uploaded/no_image.jpg')  }}"
                                        alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                        class="fi-rs-heart"></i></a>
                                <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                        class="fi-rs-shuffle"></i></a>
                                <a onclick="quickViewLoad({{$product }})" aria-label="Quick view" class="action-btn"
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                        class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">



                                <span class="hot">
                                    @if ($product->discount)
                                    {{ "save ". $product->discount . " %" }}
                                    @elseif ($product->featured)
                                    Featured
                                    @elseif ($product->special_offer)
                                    Special Offer
                                    @elseif($product->special_deal)
                                    Special Deal
                                    @else
                                    New
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="{{ route('product_by_category',$product->category->id) }}">{{
                                    $product->category->name }}</a>
                            </div>
                            <h2><a
                                    href="{{ route('product_details',['product' => $product->id,'slug'=>$product->product_slug] )}}">{{
                                    $product->product_name }}</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="vendor-details-1.html">{{
                                        $product->vendor->name ?? 'Owner' }}</a></span>
                            </div>
                            <div class="product-card-bottom">

                                @if($product->discount)
                                <div class="product-price">
                                    <span>${{ $product->selling_price - ($product->selling_price *
                                        ($product->discount / 100)) }}</span>
                                    <span class="old-price">${{ $product->selling_price
                                        }}</span>
                                </div>
                                @else
                                <div class="product-price">
                                    <span>${{ $product->selling_price }}
                                </div>
                                @endif
                                <div class="add-cart">
                                    <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->
                @endforeach


            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--End Deals-->


        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>
                    @foreach ($side_categories as $side_category)


                    <li>
                        <a href="shop-grid-right.html"> <img
                                src="{{ file_exists(public_path('uploaded/categories/'.$side_category->image)) ? asset('uploaded/categories/'.$side_category->image) : asset('uploaded/no_image.jpg') }}"
                                alt="" />{{ $side_category->name }}</a><span class="count">{{
                            $side_category->products_count }}</span>
                    </li>
                    @endforeach

                </ul>
            </div>
            <!-- Fillter By Price -->
            <div class="sidebar-widget price_range range mb-30">
                <h5 class="section-title style-1 mb-30">Fill by price</h5>
                <div class="price-filter">
                    <div class="price-filter-inner">
                        <div id="slider-range" class="mb-20"></div>
                        <div class="d-flex justify-content-between">
                            <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong>
                            </div>
                            <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item mb-10 mt-10">
                        <label class="fw-900">Color</label>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                            <br />
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                            <br />
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                        </div>
                        <label class="fw-900 mt-15">Item Condition</label>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                            <br />
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished
                                    (27)</span></label>
                            <br />
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31"
                                value="" />
                            <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                        </div>
                    </div>
                </div>
                <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                    Fillter</a>
            </div>
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                @foreach ($new_products as $new_product)


                <div class="single-post clearfix">
                    <div class="image">
                        <img src="{{ file_exists(public_path('uploaded/product/'.$new_product->thumbnail)) ? asset('uploaded/product/'.$new_product->thumbnail ) : asset('uploaded/no_image.jpg') }}"
                            alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h5><a href="shop-product-detail.html">{{ Str::words($new_product->product_name,4,'...') }}</a>
                        </h5>
                        <p class="price mb-0 mt-5">
                            @if ($new_product->discount)
                            {{ $new_product->selling_price - ($new_product->selling_price *($new_product->discount /
                            100)) }}
                            @else
                            {{ $new_product->selling_price }}
                            @endif
                        </p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                <img src="{{ asset('frontend') }}/assets/imgs/banner/banner-11.png" alt="" />
                <div class="banner-text">
                    <span>Oganic</span>
                    <h4>
                        Save 17% <br />
                        on <span class="text-brand">Oganic</span><br />
                        Juice
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection