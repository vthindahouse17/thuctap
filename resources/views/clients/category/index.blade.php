@extends('layouts.clients')

@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ $data->name }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">{{ $data->name }}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
    	<div class="row">
			<div class="col-12">
            	<div class="row align-items-center mb-4 pb-1">
                    <div class="col-12">
                        <div class="product_header">
                            <div class="product_header_left">

                            </div>
                            <div class="product_header_right">
                            	<div class="products_view">
                                    <a href="javascript:Void(0);" class="shorting_icon grid"><i class="ti-view-grid"></i></a>
                                    <a href="javascript:Void(0);" class="shorting_icon list active"><i class="ti-layout-list-thumb"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row shop_container list">
                    @if ($product->isNotEmpty())
                    @foreach ($product as $row)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="product">
                            <div class="product_img">
                                <a href="{{ route('product/{slug}', ['slug' => $row->pslug]) }}">
                                    <img src="{{ asset('assets/clients/uploads/product/') . '/' . $row->pimage }}" alt="product_img1">
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{ route('product/{slug}', ['slug' => $row->pslug]) }}">{{ $row->pname }}</a></h6>
                                <div class="product_price">
                                    <span class="price">{{ Helper::format_number($row->price) }}đ</span>
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
                    @else
                    <p class="h4 text-center text-danger mt-2">Hiện tại chưa có sản phẩm nào!</p>
                @endif

                </div>
        	</div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->



</div>
<!-- END MAIN CONTENT -->
@endsection
