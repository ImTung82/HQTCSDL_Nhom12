@extends('layouts.menu')

@section('title', 'Thêm Khách Hàng Mới')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Khách Hàng Mới</h1>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hiển thị thông báo lỗi -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form thêm khách hàng -->
    <form action="{{ route('khachhang.store') }}" method="POST">
        @csrf

        <!-- ID Khách Hàng -->
        <div class="mb-3">
            <label for="IDKhachHang" class="form-label">ID Khách Hàng</label>
            <input type="text" name="IDKhachHang" id="IDKhachHang" class="form-control" value="{{ old('IDKhachHang') }}" required>
        </div>

        <!-- Họ Tên -->
        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ Tên</label>
            <input type="text" name="HoTen" id="HoTen" class="form-control" value="{{ old('HoTen') }}" required>
        </div>

        <!-- Ngày Sinh -->
        <div class="mb-3">
            <label for="NgaySinh" class="form-label">Ngày Sinh</label>
            <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" value="{{ old('NgaySinh') }}">
        </div>

        <!-- Giới Tính -->
        <div class="mb-3">
            <label for="GioiTinh" class="form-label">Giới Tính</label>
            <select name="GioiTinh" id="GioiTinh" class="form-select">
                <option value="">-- Chọn Giới Tính --</option>
                <option value="Nam" {{ old('GioiTinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('GioiTinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ old('GioiTinh') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <!-- Địa Chỉ -->
        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa Chỉ</label>
            <input type="text" name="DiaChi" id="DiaChi" class="form-control" value="{{ old('DiaChi') }}">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="Email" id="Email" class="form-control" value="{{ old('Email') }}">
        </div>

        <!-- Số Điện Thoại -->
        <div class="mb-3">
            <label for="SoDienThoai" class="form-label">Số Điện Thoại</label>
            <input type="text" name="SoDienThoai" id="SoDienThoai" class="form-control" value="{{ old('SoDienThoai') }}">
        </div>

        <!-- Nút Thêm Khách Hàng -->
        <button type="submit" class="btn btn-primary">Thêm Khách Hàng</button>
    </form>
</div>
@endsection
