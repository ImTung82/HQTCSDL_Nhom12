@extends('layouts.menu')

@section('content')
<div class="container">
    <h2>Thêm Đơn Hàng Mới</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donhang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="IDDonHang" class="form-label">Mã Đơn Hàng</label>
            <input type="text" class="form-control" id="IDDonHang" name="IDDonHang" value="{{ old('IDDonHang') }}" required>
        </div>

        <div class="mb-3">
            <label for="IDKhachHang" class="form-label">Khách Hàng</label>
            <select class="form-control" id="IDKhachHang" name="IDKhachHang" required>
                <option value="">-- Chọn Khách Hàng --</option>
                @foreach ($khachHangs as $khachHang)
                    <option value="{{ $khachHang->IDKhachHang }}" {{ old('IDKhachHang') == $khachHang->IDKhachHang ? 'selected' : '' }}>
                        {{ $khachHang->KhachHangInfo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="IDNhanVien" class="form-label">Nhân Viên</label>
            <select class="form-control" id="IDNhanVien" name="IDNhanVien" required>
                <option value="">-- Chọn Nhân Viên --</option>
                @foreach ($nhanViens as $nhanVien)
                    <option value="{{ $nhanVien->IDNhanVien }}" {{ old('IDNhanVien') == $nhanVien->IDNhanVien ? 'selected' : '' }}>
                        {{ $nhanVien->NhanVienInfo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="NgayTaoDonHang" class="form-label">Ngày Tạo Đơn Hàng</label>
            <input type="date" class="form-control" id="NgayTaoDonHang" name="NgayTaoDonHang" value="{{ old('NgayTaoDonHang') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Đơn Hàng</button>
    </form>
</div>
@endsection
