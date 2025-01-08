@extends('layouts.menu')

@section('title', 'Danh Sách Khách Hàng')

@section('content')
<div class="container mt-5">
    <h1>Danh Sách Khách Hàng</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Kiểm tra nếu có dữ liệu -->
    @if(isset($khachHangData) && count($khachHangData) > 0)
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
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($khachHangData as $khachHang)
                    <tr>
                        <td>{{ $khachHang->IDKhachHang }}</td>
                        <td>{{ $khachHang->HoTen }}</td>
                        <td>{{ $khachHang->NgaySinh }}</td>
                        <td>{{ $khachHang->GioiTinh }}</td>
                        <td>{{ $khachHang->SoDienThoai }}</td>
                        <td>{{ number_format($khachHang->TongTienDaMua, 3) }}$</td>
                        <td>{{ $khachHang->MucDoThanThiet }}</td>
                        <td>{{ number_format($khachHang->MucGiam, 3) * 100}}%</td>
                        <td>
                            <!-- Nút sửa -->
                            <a href="{{ route('khachhang.edit', $khachHang->IDKhachHang) }}" class="btn btn-warning btn-sm">Sửa</a>

                            <!-- Nút xóa -->
                            <form action="{{ route('khachhang.destroy', $khachHang->IDKhachHang) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-warning">Không có dữ liệu khách hàng.</p>
    @endif
</div>
@endsection
