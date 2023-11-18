@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa chuyên mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sửa chuyên mục</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.postEditCategory') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên chuyên mục</label>
                                        <input type="text" class="form-control" placeholder="Tên chuyên mục"
                                            name="name" id="title" onkeyup="ChangeToSlug();"
                                            value="{{$data->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Đường dẫn</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Đường dẫn"
                                            name="slug" value="{{ $data->slug}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Hình ảnh</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="exampleInputFile">
                                        </div>
                                        @if ($data->image)
                                            <img src="{{ asset('assets/clients/uploads/category/') . '/' . $data->image }}"
                                                id="imagePreview" width="200px" class="file-preview mt-3" />
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Sửa chuyên mục</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
