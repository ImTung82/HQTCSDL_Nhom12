@extends('layouts.menu')

@section('title', 'Cập Nhật Sản Phẩm')

@section('content')
<div class="container mt-5">
    <h1>Chỉnh Sửa Sản Phẩm</h1>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sanpham.update', $product->IDSanPham) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IDSanPham" class="form-label">ID Sản Phẩm</label>
            <input type="text" class="form-control" id="IDSanPham" name="IDSanPham" value="{{ $product->IDSanPham }}" readonly>
        </div>

        <div class="mb-3">
            <label for="TenSanPham" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="TenSanPham" name="TenSanPham" value="{{ old('TenSanPham', $product->TenSanPham) }}" required>
        </div>

       <div class="mb-3">
    <label for="IDNhaCungCap" class="form-label">Nhà Cung Cấp</label>
    <select class="form-control" id="IDNhaCungCap" name="IDNhaCungCap" required>
        <option value="" disabled selected>Lựa chọn nhà cung cấp</option>
        @foreach ($nhaCungCapList as $ncc)
            <option value="{{ $ncc->IDNhaCungCap }}" {{ old('IDNhaCungCap', $product->IDNhaCungCap) == $ncc->IDNhaCungCap ? 'selected' : '' }}>
                {{ $ncc->TenNhaCungCap }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="IDLoaiHang" class="form-label">Loại Hàng</label>
    <select class="form-control" id="IDLoaiHang" name="IDLoaiHang" required>
        <option value="" disabled selected>Lựa chọn loại hàng</option>
        @foreach ($loaiHangList as $lh)
            <option value="{{ $lh->IDLoaiHang }}" {{ old('IDLoaiHang', $product->IDLoaiHang) == $lh->IDLoaiHang ? 'selected' : '' }}>
                {{ $lh->TenLoaiHang }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label for="SoLuongCon" class="form-label">Số Lượng Còn</label>
            <input type="number" class="form-control" id="SoLuongCon" name="SoLuongCon" value="{{ old('SoLuongCon', $product->SoLuongCon) }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="DonGiaNhap" class="form-label">Đơn Giá Nhập</label>
            <input type="number" class="form-control" id="DonGiaNhap" name="DonGiaNhap" value="{{ old('DonGiaNhap', $product->DonGiaNhap) }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="DonGiaBan" class="form-label">Đơn Giá Bán</label>
            <input type="number" class="form-control" id="DonGiaBan" name="DonGiaBan" value="{{ old('DonGiaBan', $product->DonGiaBan) }}" required min="0">
        </div>

<div class="mb-3">
    <label for="TyLeGiamGia" class="form-label">Tỷ Lệ Giảm Giá</label>
    <input type="number" class="form-control" id="TyLeGiamGia" name="TyLeGiamGia" value="{{ old('TyLeGiamGia', $product->TyLeGiamGia * 100) }}" min="0" max="100">
</div>


        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('sanpham.allsanpham') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
