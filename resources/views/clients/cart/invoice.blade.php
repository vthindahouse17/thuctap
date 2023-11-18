@extends('layouts.clients')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <div class="product d-block">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Hóa đơn #{{$data->id}}
                    <strong>{{Helper::format_date($data->created_at)}}</strong>
                    <span class="float-end"> <strong>Trạng thái:</strong>
                    @if($data->status == 1) <span class="text-success">Đã thanh toán</span>
                    @elseif($data->status == 0) <span class="text-danger">Chưa thanh toán</span>
                    @else <span class="text-secondary">Đã hủy</span>
                    @endif
                </span>

                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">Gửi từ:</h6>
                            <div>
                                <strong>Vũ Thế Hậu</strong>
                            </div>
                            <div>Lam Sơn</div>
                            <div>Minh Cường, Thường Tín, Hà Nội </div>
                            <div>Email: vuthehau01@gmail.com</div>
                            <div>Phone: +84 349065773</div>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="mb-3">Đến:</h6>
                            <div>
                                <strong>{{$data->name}}</strong>
                            </div>
                            <div>{{$data->address}}</div>
                            <div>Email: {{$data->email}}</div>
                            <div>Số điện thoại: {{$data->phone}}</div>
                        </div>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Tên sản phẩm</th>

                                    <th class="right">Giá</th>
                                    <th class="center">Số lượng</th>
                                    <th class="right">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item as $key=> $row)
                                <tr>
                                    <td class="center">{{$key+1}}</td>
                                    <td class="left strong">{{$row->pname}}</td>

                                    <td class="right">{{Helper::format_number($row->price)}} đ</td>
                                    <td class="center">{{$row->qty}}</td>
                                    <td class="right">{{Helper::format_number($row->total)}} đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">

                        </div>

                        <div class="col-lg-6 col-sm-6 d-flex justify-content-end">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>Ship</strong>
                                        </td>
                                        <td class="right">0đ</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>VAT (0%)</strong>
                                        </td>
                                        <td class="right">0đ</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>Tổng</strong>
                                        </td>
                                        <td class="right">
                                            <strong>{{\App\Helpers\Helper::format_number($sum)}}đ</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
