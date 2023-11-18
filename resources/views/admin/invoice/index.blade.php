@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách hóa đơn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">hóa đơn</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Họ tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            {{-- <td>{{ $row->id }}</td> --}}
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->address }}
                                            </td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <p class="text-success">Đã thanh toán</p>
                                                @elseif($row->status == 0)
                                                    <p class="text-danger">Chưa thanh toán</p>
                                                @else
                                                    <p class="text-secondary">Đã hủy</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $row->created_at }}
                                            </td>
                                            <td><a data-toggle="modal" data-target="#standard-{{ $row->id }}"
                                                    class="action-icon">
                                                    <i class="fa fa-eye"></i></a></td>

                                        </tr>

                                        <!-- Modal -->

                                        <!-- Standard modal -->
                                        <div id="standard-{{ $row->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel">
                                                            Hóa đơn <b>INV
                                                                {{ $row->id }}
                                                            </b> <br>
                                                            {{ $row->name }}<br><small
                                                                class="text-muted">{{ $row->email }}</small><br>
                                                            <small class="text-muted">
                                                                {{ $row->phone }}
                                                            </small>
                                                        </h4>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex">Trạng thái: <h5>
                                                                    @if ($row->status == 1)
                                                                        <span class="text-success"> Đã thanh toán</span>
                                                                    @elseif($row->status == 0)
                                                                        <span class="text-danger"> Chưa thanh toán</span>
                                                                    @else
                                                                        <span class="text-secondary"> Đã hủy</span>
                                                                    @endif
                                                            </li>
                                                            <li class="list-group-item">Ghi chú: @if (empty($row->note))
                                                                    <p>Không có ghi chú</p>
                                                                @else
                                                                    {{ $row->note }}
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item">Địa chỉ: {{ $row->address }}</li>
                                                            <li class="list-group-item">Số điện thoại: {{ $row->phone }}</li>
                                                            <li class="list-group-item">Thời gian tạo hóa đơn:
                                                                <?= date('d-m-Y H:i:s', strtotime($row->created_at)) ?>
                                                            </li>
                                                            <li class="list-group-item">Chi tiết hóa đơn: <a
                                                                    href="{{ route('invoice', ['id' => $row->id]) }}">Xem
                                                                    tại đây</a></li>
                                                        </ul>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.postEditInvoice')}}" method="post">
                                                                @csrf
                                                                <input type="text" value="{{ $row->id }}"
                                                                    name="id" hidden>
                                                                <div class="row w-100" >
                                                                    <div class="col-md-4">
                                                                      <button type="submit" name="cancel" class="btn btn-dark btn-block" value="2">Hủy</button>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <button type="submit" name="wait" class="btn btn-warning btn-block" value="0">Chưa t.toán</button>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <button type="submit" name="done" class="btn btn-success btn-block" value="1">Thanh toán</button>
                                                                    </div>
                                                                  </div>

                                                                  <style>
                                                                    .row {
                                                                      display: flex;
                                                                      justify-content: center;
                                                                    }
                                                                  </style>

                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
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
@section('js')
    <script>
        $('#example1').DataTable({
            // ...các tùy chọn khác
            "order": [
                ['id', "desc"]
            ]
        });
    </script>
@endsection
