@extends('layouts.clients')
@section('css')
@endsection
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Đăng ký</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đăng ký</li>
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
                            <h3>Tạo tài khoản mới</h3>
                        </div>
                        <form action="{{ route('postSignup') }}" method="POST">
                            <div class="form-group mb-3">
                                <input type="text"  class="form-control" placeholder="Tài khoản" name="username"
                                value="{{old('username')}}">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control"  placeholder="Mật khẩu" name="password"
                                value="{{old('password')}}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="password" placeholder="Mật khẩu" name="password_confirmation"
                                value="{{old('repassword')}}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" placeholder="Họ và tên" name="name"
                                value="{{old('name')}}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" placeholder="Số điện thoại" name="phone"
                                value="{{old('phone')}}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="email" placeholder="Email" name="email"
                                value="{{old('email')}}">
                            </div>
                            <div class="form-group mb-3">
                                @csrf
                                <button type="submit" class="btn btn-fill-out btn-block" name="register">Đăng ký</button>
                            </div>
                        </form>

                        <div class="form-note text-center">Đã có tài khoản ? <a href="{{route('login')}}">Đăng nhập</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->


</div>
<!-- END MAIN CONTENT -->

@endsection
