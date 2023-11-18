@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-info" href="{{route('admin.addProduct')}}">Thêm sản phẩm</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Chuyên mục</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đăng</th>
                                        <th>Tùy chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td><img src="{{ asset('assets/clients/uploads/product/').'/'.$row->pimage }}" style="width:80px"></td>
                                            <td>{{ $row->pname }}
                                            </td>
                                            <td>{{$row->name}}</td>
                                            <td>{{ Helper::format_number($row->price) }}đ</td>
                                            <td>{{$row->amount}}</td>
                                            <td>@if($row->status ==1) <p class="text-success">Hiện</p> @else <p class="text-danger">Ẩn</p> @endif</td>
                                            <td>{{Helper::format_date($row->created_at)}}</td>
                                            <td>
                                                <a href="{{route('admin.editProduct')}}/{{$row->pid}}">Sửa | </a>
                                                <a href="{{route('admin.deleteProduct')}}/{{$row->pid}}">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
