@extends('layouts.clients')
@section('css')
@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img id="product_img" src='{{ asset('assets/clients/uploads/product/') . '/' . $data->pimage }}'
                                data-zoom-image="{{ asset('assets/clients/uploads/product/') . '/' . $data->pimage }}"
                                alt="product_img1" />
                            <a href="#" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4"
                            data-slides-to-scroll="1" data-infinite="false">
                            <div class="item">
                                <a href="#" class="product_gallery_item active"
                                    data-image="{{ asset('assets/clients/uploads/product/') . '/' . $data->pimage }}"
                                    data-zoom-image="{{ asset('assets/clients/uploads/product/') . '/' . $data->pimage }}">
                                    <img src="{{ asset('assets/clients/uploads/product/') . '/' . $data->pimage }}"
                                        alt="product_small_img1" />
                                </a>
                            </div>
                            @foreach (json_decode($data->listimg) as $image)
                                <div class="item">
                                    <a href="#" class="product_gallery_item active"
                                        data-image="{{ asset('assets/clients/uploads/product/' . $image) }}"
                                        data-zoom-image="{{ asset('assets/clients/uploads/product/' . $image) }}">
                                        <img src="{{ asset('assets/clients/uploads/product/' . $image) }}"
                                            alt="product_small_img1" />
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title"><a>{{ $data->pname }}</a></h4>
                            <div class="product_price">
                                <span class="price">{{ Helper::format_number($data->price) }}đ</span>
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:80%"></div>
                                </div>
                                <span class="rating_num">(1)</span>
                            </div>
                            <div class="pr_desc d-block">

                            </div>

                        </div>
                        <br><hr class="mt-5">
                        <div class="d-block product_sort_info">
                            <ul>
                                <li><i class="linearicons-shield-check"></i> Bảo hành thương hiệu AL Jazeera 1 năm</li>
                                <li><i class="linearicons-sync"></i> Chính sách đổi trả trong 30 ngày</li>
                                <li><i class="linearicons-bag-dollar"></i> Tiền mặt khi giao hàng có sẵn</li>
                            </ul>
                        </div>
                        <hr />
                        <div class="cart_extra">
                            {{-- <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="quantity" value="1" title="Qty" class="qty"
                                        size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div> --}}
                            <div class="form-submit cart_btn">
                                <input type="hidden" class="pid" value="{{ $data->pid }}">
                                <input type="hidden" class="pname" value="{{ $data->pname }}">
                                <input type="hidden" class="pprice" value="{{ $data->price }}">
                                <input type="hidden" class="pimage" value="{{ $data->pimage }}">
                                <input type="hidden" class="pqty" value="1">
                                @csrf
                                <button class="addItemBtn2 btn btn-fill-out " type="button"><i
                                        class="icon-basket-loaded"></i>>Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                        <hr />
                        <ul class="product-meta">
                            <li>SKU: <a href="#">SKU{{$data->id}}</a></li>
                            <li>Category: <a href="{{ route('category/{slug}', ['slug' => $data->slug]) }}">{{ $data->name }}</a></li>

                        </ul>

                        <div class="product_share">
                            <span>Share:</span>
                            <ul class="social_icons">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description"
                                    role="tab" aria-controls="Description" aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                    href="#Additional-info" role="tab" aria-controls="Additional-info"
                                    aria-selected="false">Thông tin sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews"
                                    role="tab" aria-controls="Reviews" aria-selected="false">Đánh giá (2)</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                aria-labelledby="Description-tab">
                                {!! $data->description !!}
                            </div>
                            <div class="tab-pane fade" id="Additional-info" role="tabpanel"
                                aria-labelledby="Additional-info-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Số lượng</td>
                                        <td>{{$data->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Giá</td>
                                        <td>{{ Helper::format_number($data->price) }}đ</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                                <div class="comments">
                                    <h5 class="product_tab_title">2 Review For <span>Blue Dress For Woman</span></h5>
                                    <ul class="list_none comment_list mt-4">
                                        <li>
                                            <div class="comment_img">
                                                <img src="assets/images/user1.jpg" alt="user1" />
                                            </div>
                                            <div class="comment_block">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:80%"></div>
                                                    </div>
                                                </div>
                                                <p class="customer_meta">
                                                    <span class="review_author">Alea Brooks</span>
                                                    <span class="comment-date">March 5, 2018</span>
                                                </p>
                                                <div class="description">
                                                    <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean
                                                        sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum,
                                                        nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment_img">
                                                <img src="assets/images/user2.jpg" alt="user2" />
                                            </div>
                                            <div class="comment_block">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:60%"></div>
                                                    </div>
                                                </div>
                                                <p class="customer_meta">
                                                    <span class="review_author">Grace Wong</span>
                                                    <span class="comment-date">June 17, 2018</span>
                                                </p>
                                                <div class="description">
                                                    <p>It is a long established fact that a reader will be distracted by the
                                                        readable content of a page when looking at its layout. The point of
                                                        using Lorem Ipsum is that it has a more-or-less normal distribution
                                                        of letters</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="review_form field_form">
                                    <h5>Add a review</h5>
                                    <form class="row mt-3">
                                        <div class="form-group col-12 mb-3">
                                            <div class="star_rating">
                                                <span data-value="1"><i class="far fa-star"></i></span>
                                                <span data-value="2"><i class="far fa-star"></i></span>
                                                <span data-value="3"><i class="far fa-star"></i></span>
                                                <span data-value="4"><i class="far fa-star"></i></span>
                                                <span data-value="5"><i class="far fa-star"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input required="required" placeholder="Enter Name *" class="form-control"
                                                name="name" type="text">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input required="required" placeholder="Enter Email *" class="form-control"
                                                name="email" type="email">
                                        </div>

                                        <div class="form-group col-12 mb-3">
                                            <button type="submit" class="btn btn-fill-out" name="submit"
                                                value="Submit">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Sản phẩm liên quan</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20"
                        data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        @foreach ($product as $row)
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="{{ route('product/{slug}', ['slug' => $row->slug]) }}">
                                        <img src="{{ asset('assets/clients/uploads/product/') . '/' . $row->image }}" alt="product_img1">
                                    </a>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product/{slug}', ['slug' => $row->slug]) }}">{{ $row->name }}</a>
                                    </h6>
                                    <div class="product_price">
                                        <span class="price">{{ Helper::format_number($row->price) }}</span>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(1)</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection
