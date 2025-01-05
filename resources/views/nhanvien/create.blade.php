@extends('layouts.menu')

@section('title', 'Thêm Nhân Viên')

@section('content')
<div class="container mt-5">
    <h1>Thêm Nhân Viên</h1>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form thêm nhân viên -->
    <form action="{{ route('nhanvien.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="IDNhanVien" class="form-label">ID Nhân Viên</label>
            <input type="text" class="form-control" id="IDNhanVien" name="IDNhanVien" value="{{ old('IDNhanVien') }}">
            @error('IDNhanVien') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ Tên</label>
            <input type="text" class="form-control" id="HoTen" name="HoTen" value="{{ old('HoTen') }}">
            @error('HoTen') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="NgaySinh" class="form-label">Ngày Sinh</label>
            <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="{{ old('NgaySinh') }}">
            @error('NgaySinh') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="GioiTinh" class="form-label">Giới Tính</label>
            <select class="form-control" id="GioiTinh" name="GioiTinh">
                <option value="Nam" {{ old('GioiTinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('GioiTinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ old('GioiTinh') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
            @error('GioiTinh') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa Chỉ</label>
            <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="{{ old('DiaChi') }}">
            @error('DiaChi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}">
            @error('Email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="SoDienThoai" class="form-label">Số Điện Thoại</label>
            <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" value="{{ old('SoDienThoai') }}">
            @error('SoDienThoai') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
    </form>
</div>
@endsection
