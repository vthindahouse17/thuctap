@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm banner</li>
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
                            <form action="{{route('admin.postEditBanner')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tiêu đề</label>
                                        <input type="text" class="form-control" placeholder="Tiêu đề" name="title" id="title"  onkeyup="ChangeToSlug();"
                                        value="{{old('title', $data->title)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nội dung nút</label>
                                        <input type="text" class="form-control" placeholder="Nội dung nút" name="button_text" id="button_text"  onkeyup="ChangeToSlug();"
                                        value="{{old('button_text', $data->button_text)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Đường dẫn nút</label>
                                        <input type="text" class="form-control" placeholder="Đường dẫn nút" name="button_link" id="button_link"  onkeyup="ChangeToSlug();"
                                        value="{{old('button_link', $data->button_link)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả</label>
                                        <input type="text" class="form-control" placeholder="Mô tả" name="description" id="description"  onkeyup="ChangeToSlug();"
                                        value="{{old('description', $data->description)}}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label>Trạng thái</label>
                                            <div class="m-t-10 m-checkbox-inline custom-radio-ml">
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="status" type="radio"
                                                        name="status" value="1" {{$data->status == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label mb-0" for="status">Hiện</label>
                                                </div>
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="status" type="radio"
                                                        name="status" value="0" {{$data->status == 0 ? 'checked' : ''}}>
                                                    <label class="form-check-label mb-0" for="nostatus">Ẩn</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Hình ảnh</label>
                                        <div class="input-group">
                                                <input type="file" name="image" id="exampleInputFile">
                                                @if ($data->image)
                                                <img src="{{ asset('assets/clients/uploads/banner/') . '/' . $data->image }}"
                                                    id="imagePreview" width="200px" class="file-preview mt-3" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Sửa banner</button>
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
