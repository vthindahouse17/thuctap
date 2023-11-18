@extends('layouts.clients')
@section('css')
    <style>
    </style>
@endsection
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Giỏ hàng</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Giỏ hàng</li>
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
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                                <th class="product-remove">Hành động</th>
                                <th>
                                    <a href="{{route('cart.deleteAll')}}" class="badge-danger badge p-1" style="color:red"
                                        onclick="return confirm('Bạn có muốn xóa hết sản phẩm trong giỏ hàng?');">Xóa
                                        hết</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                        	<tr>
                            	<td class="product-thumbnail"><a href="#"><img src="{{ asset('assets/clients/uploads/product/') . '/' . $row->image }}" alt="product1"></a></td>
                                <td class="product-name" data-title="Product"><a href="#">{{ $row->name }}</a></td>
                                <td class="product-price" data-title="Price">{{ Helper::format_number($row->price) }}đ</td>
                                <input type="hidden" class="pid" value="{{$row->id}}">
                                        <input type="hidden" class="procid" value="{{$row->pid}}">
                                        <input type="hidden" class="pprice" value="{{$row->price}}">
                                        @csrf
                                <td class="product-quantity" data-title="Quantity"><div class="quantity">
                                    <input type="number" name="quantity"
                                    class="form-control input-number itemQty" value="{{$row->qty}}">
                              </div></td>
                              	<td class="product-subtotal" data-title="Total">{{Helper::format_number($row->total)}}đ</td>
                                <td class="product-remove" data-title="Remove">
                                    <a href="{{ route('cart.delete', ['id' => $row->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm này?');"><i class="ti-close"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="row cart-buttons mt-3">
            <div class="col-6"><a href="{{ route('home') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
            </div>
            <div class="col-6"><a href="{{route('checkout')}}" class="btn btn-success float-end">Thanh toán</a></div>
        </div>
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
       
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
@endsection
