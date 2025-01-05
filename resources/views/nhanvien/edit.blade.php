@extends('layouts.menu')

@section('title', 'Chỉnh Sửa Nhân Viên')

@section('content')
<div class="container mt-5">
    <h1>Chỉnh Sửa Nhân Viên</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hiển thị thông báo lỗi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form chỉnh sửa nhân viên -->
    <form action="{{ route('nhanvien.update', $nhanVien->IDNhanVien) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IDNhanVien" class="form-label">ID Nhân Viên</label>
            <input type="text" class="form-control" id="IDNhanVien" name="IDNhanVien" value="{{ $nhanVien->IDNhanVien }}" readonly>
        </div>

        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ Tên</label>
            <input type="text" class="form-control" id="HoTen" name="HoTen" value="{{ $nhanVien->HoTen }}">
        </div>

        <div class="mb-3">
            <label for="NgaySinh" class="form-label">Ngày Sinh</label>
            <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="{{ $nhanVien->NgaySinh }}">
        </div>

        <div class="mb-3">
            <label for="GioiTinh" class="form-label">Giới Tính</label>
            <select class="form-control" id="GioiTinh" name="GioiTinh">
                <option value="Nam" {{ $nhanVien->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $nhanVien->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ $nhanVien->GioiTinh == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa Chỉ</label>
            <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="{{ $nhanVien->DiaChi }}">
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="{{ $nhanVien->Email }}">
        </div>

        <div class="mb-3">
            <label for="SoDienThoai" class="form-label">Số Điện Thoại</label>
            <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" value="{{ $nhanVien->SoDienThoai }}">
        </div>

        <div class="mb-3">
            <label for="NgayBatDauLamViec" class="form-label">Ngày Bắt Đầu Làm Việc</label>
            <input type="date" class="form-control" id="NgayBatDauLamViec" name="NgayBatDauLamViec" value="{{ $nhanVien->NgayBatDauLamViec }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('nhanvien.allnhanvien') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
