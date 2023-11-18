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
                            <form action="{{ route('admin.postEditProduct') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control" placeholder="Tên sản phẩm" name="name"
                                            id="title" onkeyup="ChangeToSlug();" value="{{ $data->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Đường dẫn</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Đường dẫn"
                                            name="slug" value="{{ $data->slug }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label categories-basic">
                                            Chuyên mục</label>
                                        <select class="custom-select form-control" name="category">
                                            @foreach ($cate as $row)
                                                <option value={{ $row->id }}> {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Giá</label>
                                        <input class="form-control" name="price" type="number"
                                            value="{{ $data->price }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="validationCustom02" class="col-form-label">
                                            Số lượng</label>
                                        <input class="form-control" name="amount" type="number"
                                            value="{{ $data->amount }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control" name="description" id="editor1" rows="3">{{ $data->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label"> Trạng thái</label>
                                        <div class="m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                            <select class="custom-select form-control" name="status">
                                                <option value="<?= $data['status'] ?>" hidden>
                                                    @if ($data->status == 1)
                                                        Hiển thị
                                                    @else
                                                        Ẩn
                                                    @endif
                                                </option>
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputFile">Hình ảnh</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="exampleInputFile">
                                        </div>
                                        @if ($data->image)
                                            <img src="{{ asset('assets/clients/uploads/product/') . '/' . $data->image }}"
                                                id="imagePreview" width="200px" class="file-preview" />
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email">List hình <span class="h6" style="color:red">Thêm
                                                nhiều ảnh bằng cách nhấn
                                                CTRL+CLICK ẢNH</span></label>
                                        <div class="input-group">
                                            <input type="file" name="listimg[]" multiple>
                                        </div>
                                        @if ($data->listimg)
                                            @foreach (json_decode($data->listimg) as $image)
                                                <img src="{{ asset('assets/clients/uploads/product/' . $image) }}"
                                                    id="imagePreview" width="200px" class="file-preview ml-2" />
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
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
