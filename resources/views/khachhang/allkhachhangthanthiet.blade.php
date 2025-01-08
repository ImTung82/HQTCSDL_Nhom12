@extends('layouts.menu')

@section('title', 'Danh Sách Khách Hàng Thân Thiết')

@section('content')
<div class="container mt-5">
    <h1>Danh Sách Khách Hàng Thân Thiết</h1>

    <a href="{{ route('khachhang.updatekhachhangthanthiet') }}" class="btn btn-primary mb-4">Cập nhật thông tin</a>

    <!-- Kiểm tra nếu có dữ liệu -->
    @if(isset($khachHangThanThietData) && count($khachHangThanThietData) > 0)
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Khách Hàng</th>
                    <th>Họ Tên</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Tiền Đã Mua</th>
                    <th>Mức Độ Thân Thiết</th>
                    <th>Mức Giảm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($khachHangThanThietData as $khachHang)
                    <tr>
                        <td>{{ $khachHang->IDKhachHang }}</td>
                        <td>{{ $khachHang->HoTen }}</td>
                        <td>{{ $khachHang->NgaySinh }}</td>
                        <td>{{ $khachHang->GioiTinh }}</td>
                        <td>{{ $khachHang->SoDienThoai }}</td>
                        <td>{{ number_format($khachHang->TongTienDaMua, 3) }}$</td>
                        <td>{{ $khachHang->MucDoThanThiet }}</td>
                        <td>{{ number_format($khachHang->MucGiam, 3) * 100 }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-warning">Không có dữ liệu khách hàng thân thiết.</p>
    @endif
</div>
@endsection
