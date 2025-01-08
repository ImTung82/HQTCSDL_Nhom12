@extends('layouts.menu')

@section('title', 'Thêm Sản Phẩm')

@section('content')
<div class="container mt-5">
    <h1>Thêm Sản Phẩm</h1>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form thêm nhân viên -->
    <form action="{{ route('sanpham.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="IDSanPham" class="form-label">ID Sản phẩm</label>
            <input type="text" class="form-control" id="IDSanPham" name="IDSanPham"value="{{ old('IDSanPham') }}" required>
        </div>
        <div class="mb-3">
            <label for="TenSanPham" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="TenSanPham" name="TenSanPham" required>
        </div>

        <div class="mb-3">
            <label for="IDNhaCungCap" class="form-label">Nhà Cung Cấp</label>
            <select class="form-control" id="IDNhaCungCap" name="IDNhaCungCap" required>
                <option value="" disabled selected>Lựa chọn nhà cung cấp</option>
                @foreach ($nhaCungCapList as $ncc)
                    <option value="{{ $ncc->IDNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="IDLoaiHang" class="form-label">Loại Hàng</label>
            <select class="form-control" id="IDLoaiHang" name="IDLoaiHang" required>
                <option value="" disabled selected>Lựa chọn loại hàng</option>
                @foreach ($loaiHangList as $lh)
                    <option value="{{ $lh->IDLoaiHang }}">{{ $lh->TenLoaiHang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="SoLuongCon" class="form-label">Số Lượng Còn</label>
            <input type="number" class="form-control" id="SoLuongCon" name="SoLuongCon" required min="0">
        </div>

        <div class="mb-3">
            <label for="DonGiaNhap" class="form-label">Đơn Giá Nhập</label>
            <input type="number" class="form-control" id="DonGiaNhap" name="DonGiaNhap" required min="0" step="0.01">
        </div>

        <div class="mb-3">
            <label for="DonGiaBan" class="form-label">Đơn Giá Bán</label>
            <input type="number" class="form-control" id="DonGiaBan" name="DonGiaBan" required min="0" step="0.01">
        </div>

<div class="mb-3">
    <label for="TyLeGiamGia" class="form-label">Tỷ Lệ Giảm Giá (VD: 10, 20, ...)</label>
    <input type="number" class="form-control" id="TyLeGiamGia" name="TyLeGiamGia" value="{{ old('TyLeGiamGia') }}" max="100" step="0.01">
</div>



        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        <a href="{{ route('sanpham.allsanpham') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
