@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách chuyên mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chuyên mục</li>
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
                            <a class="btn btn-info" href="{{route('admin.addCategory')}}">Thêm chuyên mục</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên chuyên mục</th>
                                        <th>Đường dẫn</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td><img src="{{ asset('assets/clients/uploads/category/').'/'.$row->image }}" style="width:80px"></td>
                                            <td>{{ $row->name }}
                                            </td>
                                            <td>{{ $row->slug }}</td>
                                            <td>
                                                <a href="{{route('admin.editCategory')}}/{{$row->id}}">Sửa | </a>
                                                <a href="{{route('admin.deleteCategory')}}/{{$row->id}}">Xóa</a>
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
