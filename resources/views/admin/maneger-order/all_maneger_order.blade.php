@extends('admin.layouts.master')
@section('title')
<title>All Maneger</title>
@endsection
@section('nametitle')
    All_Maneger
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách đơn hàng </h4>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tình trạng đặt hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($manege_order as $order)
                                {{-- @php
                                $i++;
                                @endphp --}}
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$order->order_code}}</td>
                                    @if ($order->order_status == 1)
                                        <td>Đơn hàng mới</td>
                                    @else
                                    <td>Đơn hàng đã xử xý</td>
                                    @endif
                                    <td>{{$order->order_date}}</td>
                                    <td><td><a  href="{{route('vieworder', $order->order_code)}}"><i class="fa fa-eye" aria-hidden="true"></i> Xem đơn hàng</a></td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$manege_order->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
