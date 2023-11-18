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
                        <h1>Đăng nhập</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng nhập</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3>Đăng nhập</h3>
                                </div>
                                <form action="{{ route('postLogin') }}" method="POST">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Tài khoản">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Mật khẩu">
                                    </div>
                                    <div class="login_footer form-group mb-3">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="exampleCheckbox1" value="">
                                                <label class="form-check-label" for="exampleCheckbox1"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Quên mật khẩu</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        @csrf
                                        <button type="submit" class="btn btn-fill-out btn-block" name="login">Đăng
                                            nhập</button>
                                    </div>
                                </form>

                                <div class="form-note text-center">Bạn không có tài khoản? <a
                                        href="{{ route('signup') }}">Đăng ký ngay</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LOGIN SECTION -->
    @endsection
