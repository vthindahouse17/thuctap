@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Thanh toán</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thanh toán</li>
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
                        <div class="medium_divider"></div>
                        <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <form method="POST" action="{{ route('postCheckout') }}">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="heading_s1">
                                <h4>Thông tin người đặt</h4>
                            </div>
                            @csrf
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}"
                                    placeholder="Họ và tên">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" name="phone" value="{{ Auth::user()->phone }}"
                                    placeholder="Số điện thoại">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}"
                                    placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="address" value=""
                                    placeholder="Nhập địa chị chi tiết">
                            </div>


                            <div class="heading_s1">
                                <h4>Ghi chú</h4>
                            </div>
                            <div class="form-group mb-0">
                                <textarea rows="5" class="form-control" name="note" placeholder="Nhập ghi chú cho shop"></textarea>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="heading_s1">
                                    <h4>Hóa đơn</h4>
                                </div>
                                <div class="table-responsive order_table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $row['name'] }} <span class="product-qty">x
                                                            {{ $row['qty'] }}</span></td>
                                                    <td>{{ Helper::format_number($row['total']) }}đ</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tổng</th>
                                                <td class="product-subtotal">{{ Helper::format_number($sum) }}đ</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <button name="Checkout" type="submit" class="btn btn-fill-out btn-block">Thanh
                                    toán</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->
@endsection
