@extends('frontend.layout.frontend_master')

@section('frontend')

<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                @foreach ($sliders as $slider)

                <div class="single-hero-slider single-animation-wrap"
                    style="background-image: url({{ file_exists(public_path('uploaded/sliders/'.$slider->image)) ? asset('uploaded/sliders/'.$slider->image) : asset('uploaded/no_image.jpg') }})">
                    <div class="slider-content">
                        <h1 class="display-2 mb-40">
                            {{ $slider->title }}
                        </h1>
                        <p class="mb-65">{{$slider->sub_title}}</p>
                        <form class="form-subcriber d-flex">
                            <input type="email" placeholder="Your emaill address" />
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
<!--End hero slider-->

<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                id="carausel-10-columns-arrows"></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">

                @foreach ($categories as $category)


                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="{{ route('product_by_category',$category->id) }}"><img
                                src="{{ file_exists(public_path('uploaded/categories/'.$category->image)) ? asset('uploaded/categories/'.$category->image) : asset('uploaded/no_image.jpg') }}"
                                alt="" /></a>
                    </figure>
                    <h6><a href="{{ route('product_by_category',$category->id) }}">{{ $category->name }}</a></h6>
                    <span>{{ $category->products_count }} items</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--End category slider-->


<section class="banners mb-25">
    <div class="container">
        <div class="row">

            @foreach($banners as $banner)



            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ file_exists(public_path('uploaded/banners/'.$banner->image)) ? asset('uploaded/banners/'.$banner->image) : asset('uploaded/no_image.jpg') }}"
                        alt="" />
                    <div class="banner-text">
                        <h4>
                            {{ $banner->title }}
                        </h4>
                        <a href="{{ route('product_by_category',$category->id) }}" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--End banners-->

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>

                @foreach($categories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab"
                        data-bs-target="#category_{{ $category->id }}" type="button" role="tab" aria-controls="tab-two"
                        aria-selected="false">{{ $category->name
                        }}</button>
                </li>
                @endforeach

            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">

                    @foreach ($products as $product )


                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                        href="{{ route('product_details',['product'=>$product->id,'slug' =>$product->product_slug]) }}">{{
                                        $product->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a
                                            href="{{ $product->vendor?->id ? route('vendor_details',$product->vendor->id): '#' }}">{{
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
                                        <input type="hidden" id="product_new_product" value="{{ $product->id }}">
                                        <a class="add" href="#"" onclick=" cartSubmit('new_product')"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->

            @foreach ($categories as $category )


            <div class="tab-pane fade show" id="category_{{ $category->id }}" role="tabpanel"
                aria-labelledby="category_{{ $category->id }}">

                <div class="row product-grid-4">

                    @foreach ($category->products as $product )



                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                <!--End product-grid-4-->
            </div>
            <!--En tab two-->
            @endforeach

        </div>
        <!--End tab-content-->
    </div>
</section>
<!--Products Tabs-->

<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="{{ route('product_by_category',$category?->id ?? '') }}" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">

                                @foreach ($feature_products as $featured_product )


                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ route('product_details',['product' => $featured_product->id,'slug' => $featured_product->product_slug]) }}">
                                                <img class="default-img"
                                                    src="{{ file_exists(public_path('uploaded/product/'.$featured_product->thumbnail)) ? asset('uploaded/product/'.$featured_product->thumbnail) : asset('uploaded/no_image.jpg')  }}"
                                                    alt="" />
                                                <img class="hover-img"
                                                    src="{{ file_exists(public_path('uploaded/product/'.$featured_product->thumbnail)) ? asset('uploaded/product/'.$featured_product->thumbnail) : asset('uploaded/no_image.jpg')  }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"
                                                href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                    class="fi-rs-shuffle"></i></a>
                                            <a onclick="quickViewLoad({{$product }})" aria-label="Quick view"
                                                class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">



                                            <span class="hot">
                                                @if ($featured_product->discount)
                                                {{ "save ". $featured_product->discount . " %" }}
                                                @elseif ($featured_product->featured)
                                                Featured
                                                @elseif ($featured_product->special_offer)
                                                Special Offer
                                                @elseif($featured_product->special_deal)
                                                Special Deal
                                                @else
                                                New
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="#">{{
                                                $featured_product->category->name }}</a>
                                        </div>
                                        <h2><a
                                                href="{{ route('product_details',['product' => $featured_product->id,'slug'=>$featured_product->product_slug] )}}">{{
                                                $featured_product->product_name }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{
                                                    $featured_product->vendor->name ?? 'Owner' }}</a></span>
                                        </div>
                                        <div class="product-card-bottom">

                                            @if($featured_product->discount)
                                            <div class="product-price">
                                                <span>${{ $featured_product->selling_price -
                                                    ($featured_product->selling_price *
                                                    ($featured_product->discount / 100)) }}</span>
                                                <span class="old-price">${{ $featured_product->selling_price
                                                    }}</span>
                                            </div>
                                            @else
                                            <div class="product-price">
                                                <span>${{ $featured_product->selling_price }}
                                            </div>
                                            @endif
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
<!--End Best Sales-->


<!-- Category With Products -->
@foreach ($categories_with_products as $category )

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $category->name }} </h3>

        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">



                    @foreach ($category->products->slice(0,5) as $product )


                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                    <a href="#">{{
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
                <!--End product-grid-4-->
            </div>


        </div>
        <!--End tab-content-->
    </div>


</section>
@endforeach
<!--End CAtegory with products -->




<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_offers as $hot_offer )


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a
                                href="{{ route('product_details',['product'=>$hot_offer->id,'slug' => $hot_offer->product_slug]) }}"><img
                                    src="{{ file_exists(public_path('uploaded/product/'.$hot_offer->thumbnail)) ? asset('uploaded/product/'.$hot_offer->thumbnail) : asset('uploaded/no_image.jpg') }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a
                                    href="{{ route('product_details',['product'=>$hot_offer->id,'slug' => $hot_offer->product_slug]) }}">{{
                                    $hot_offer->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                @if ($hot_offer->discount)
                                <span>{{ $hot_offer->selling_price - ($hot_offer->selling_price *
                                    ($hot_offer->discount/100))
                                    }}</span>
                                <span class="old-price">{{ $hot_offer->selling_price }}</span>
                                @else
                                <span>{{ $hot_offer->selling_price }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_offers as $special_offer )


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a
                                href="{{ route('product_details',['product'=>$special_offer->id,'slug' => $special_offer->product_slug]) }}"><img
                                    src="{{ file_exists(public_path('uploaded/product/'.$special_offer->thumbnail)) ? asset('uploaded/product/'.$special_offer->thumbnail) : asset('uploaded/no_image.jpg') }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a
                                    href="{{ route('product_details',['product'=>$special_offer->id,'slug' => $special_offer->product_slug]) }}">{{
                                    $special_offer->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                @if ($special_offer->discount)
                                <span>{{ $special_offer->selling_price - ($special_offer->selling_price *
                                    ($special_offer->discount/100))
                                    }}</span>
                                <span class="old-price">{{ $special_offer->selling_price }}</span>
                                @else
                                <span>{{ $special_offer->selling_price }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach ($recent_products as $recent_product )


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a
                                href="{{ route('product_details',['product'=>$recent_product->id,'slug' => $recent_product->product_slug]) }}"><img
                                    src="{{ file_exists(public_path('uploaded/product/'.$recent_product->thumbnail)) ? asset('uploaded/product/'.$recent_product->thumbnail) : asset('uploaded/no_image.jpg') }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a
                                    href="{{ route('product_details',['product'=>$recent_product->id,'slug' => $recent_product->product_slug]) }}">{{
                                    $recent_product->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                @if ($recent_product->discount)
                                <span>{{ $recent_product->selling_price - ($recent_product->selling_price *
                                    ($recent_product->discount/100))
                                    }}</span>
                                <span class="old-price">{{ $recent_product->selling_price }}</span>
                                @else
                                <span>{{ $recent_product->selling_price }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $special_deal )


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a
                                href="{{ route('product_details',['product'=>$special_deal->id,'slug' => $special_deal->product_slug]) }}"><img
                                    src="{{ file_exists(public_path('uploaded/product/'.$special_deal->thumbnail)) ? asset('uploaded/product/'.$special_deal->thumbnail) : asset('uploaded/no_image.jpg') }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a
                                    href="{{ route('product_details',['product'=>$special_deal->id,'slug' => $special_deal->product_slug]) }}">{{
                                    $special_deal->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                @if ($special_deal->discount)
                                <span>{{ $special_deal->selling_price - ($special_deal->selling_price *
                                    ($special_deal->discount/100))
                                    }}</span>
                                <span class="old-price">{{ $special_deal->selling_price }}</span>
                                @else
                                <span>{{ $special_deal->selling_price }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->


<!--Vendor List -->

<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">All Our Vendor List </h3>
        <a class="show-all" href="{{ route('vendor_list') }}">
            All Vendors
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>


    <div class="row vendor-grid">
        @foreach ($vendor_list as $vendor)


        <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
            <div class="vendor-wrap mb-40">
                <div class="vendor-img-action-wrap">
                    <div class="vendor-img">
                        <a href="vendor-details-1.html">
                            <img class="default-img"
                                src="{{ file_exists(public_path('uploaded/vendor/'.$vendor->photo)) }}" alt="" />
                        </a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Mall</span>
                    </div>
                </div>
                <div class="vendor-content-wrap">
                    <div class="d-flex justify-content-between align-items-end mb-30">
                        <div>
                            <div class="product-category">
                                <span class="text-muted">Since {{ $vendor?->created_at?->format('Y') }}</span>
                            </div>
                            <h4 class="mb-5"><a href="vendor-details-1.html">{{ $vendor->name }}</a></h4>
                            <div class="product-rate-cover">

                                <span class="font-small total-product">{{ $vendor->products_count }} products</span>
                            </div>
                        </div>

                    </div>
                    <div class="vendor-info mb-30">
                        <ul class="contact-infor text-muted">

                            <li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-contact.svg"
                                    alt="" /><strong>Call
                                    Us:</strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                    </div>
                    <a href="{{ route('vendor_details',$vendor->id) }}" class="btn btn-xs">Visit Store <i
                            class="fi-rs-arrow-small-right"></i></a>
                </div>
            </div>
        </div>
        <!--end vendor card-->
        @endforeach

    </div>
</div>

<!--End Vendor List -->


@endsection
