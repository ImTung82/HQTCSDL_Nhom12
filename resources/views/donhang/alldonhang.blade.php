@extends('layouts.menu')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <h1 class="mb-4">Danh sách đơn hàng</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Đơn Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Tên Nhân Viên Phụ Trách</th>
                <th>Ngày Tạo Đơn Hàng</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        <a href="{{ route('donhang.chitietdonhang', $item->IDDonHang) }}">
                            {{ $item->IDDonHang }}
                        </a>
                    </td>
                    <td>{{ $item->TenKhachHang }}</td>
                    <td>{{ $item->TenNhanVienPhuTrach }}</td>
                    <td>{{ $item->NgayTaoDonHang }}</td>
                    <td>{{ number_format($item->ThanhTien, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
