@extends('layouts.menu')

@section('title', 'Sửa Khách Hàng')

@section('content')
<div class="container mt-5">
    <h1>Sửa Thông Tin Khách Hàng</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('khachhang.update', $khachHang->IDKhachHang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="HoTen">Họ Tên</label>
            <input type="text" name="HoTen" id="HoTen" class="form-control" value="{{ $khachHang->HoTen }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="NgaySinh">Ngày Sinh</label>
            <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" value="{{ $khachHang->NgaySinh }}">
        </div>

        <div class="form-group mb-3">
            <label for="GioiTinh">Giới Tính</label>
            <select name="GioiTinh" id="GioiTinh" class="form-control">
                <option value="">-- Chọn Giới Tính --</option>
                <option value="Nam" {{ $khachHang->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $khachHang->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ $khachHang->GioiTinh == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="DiaChi">Địa Chỉ</label>
            <input type="text" name="DiaChi" id="DiaChi" class="form-control" value="{{ $khachHang->DiaChi }}">
        </div>

        <div class="form-group mb-3">
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" class="form-control" value="{{ $khachHang->Email }}">
        </div>

        <div class="form-group mb-3">
            <label for="SoDienThoai">Số Điện Thoại</label>
            <input type="text" name="SoDienThoai" id="SoDienThoai" class="form-control" value="{{ $khachHang->SoDienThoai }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('khachhang.allkhachhang') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
