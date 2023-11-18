@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
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
                            <form action="{{ route('admin.postAddProduct') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control" placeholder="Tên sản phẩm" name="name"
                                            id="title" onkeyup="ChangeToSlug();" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Đường dẫn</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Đường dẫn"
                                            name="slug" value="{{ old('slug') }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label categories-basic">
                                            Chuyên mục</label>
                                        <select class="custom-select form-control" name="category">
                                            @foreach ($cate as $data)
                                                <option value={{ $data->id }}> {{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Giá</label>
                                        <input class="form-control" name="price" type="number" value="{{ old('price') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="validationCustom02" class="col-form-label">
                                            Số lượng</label>
                                        <input class="form-control" name="amount" type="number" value="{{ old('amount') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control" name="description" id="editor1" rows="3">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label>Trạng thái</label>
                                            <div class="m-t-10 m-checkbox-inline custom-radio-ml">
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="status" type="radio"
                                                        name="status" value="1" checked>
                                                    <label class="form-check-label mb-0" for="status">Hiện</label>
                                                </div>
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="status" type="radio"
                                                        name="status" value="0">
                                                    <label class="form-check-label mb-0" for="nostatus">Ẩn</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputFile">Hình ảnh</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="exampleInputFile">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email">List hình <span class="h6" style="color:red">Thêm
                                                nhiều ảnh bằng cách nhấn
                                                CTRL+CLICK ẢNH</span></label>
                                        <div class="input-group">
                                            <input type="file" name="listimg[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
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
