@extends('layouts.menu')

@section('title', 'Sửa đơn hàng')

@section('content')
    <h1 class="mb-4">Sửa Đơn Hàng</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donhang.update', $donHang->IDDonHang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IDDonHang" class="form-label">ID Đơn Hàng</label>
            <input type="text" class="form-control" id="IDDonHang" value="{{ $donHang->IDDonHang }}" disabled>
        </div>

        <div class="mb-3">
            <label for="IDKhachHang" class="form-label">Khách Hàng</label>
            <select name="IDKhachHang" id="IDKhachHang" class="form-select">
                @foreach ($khachHangs as $khachHang)
                    <option value="{{ $khachHang->IDKhachHang }}"
                        {{ $khachHang->IDKhachHang == $donHang->IDKhachHang ? 'selected' : '' }}>
                        {{ $khachHang->TenKhachHang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="IDNhanVien" class="form-label">Nhân Viên Phụ Trách</label>
            <select name="IDNhanVien" id="IDNhanVien" class="form-select">
                @foreach ($nhanViens as $nhanVien)
                    <option value="{{ $nhanVien->IDNhanVien }}"
                        {{ $nhanVien->IDNhanVien == $donHang->IDNhanVien ? 'selected' : '' }}>
                        {{ $nhanVien->TenNhanVien }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="NgayTaoDonHang" class="form-label">Ngày Tạo Đơn Hàng</label>
            <input type="date" name="NgayTaoDonHang" class="form-control" id="NgayTaoDonHang"
                   value="{{ $donHang->NgayTaoDonHang }}">
        </div>

        <button type="submit" class="btn btn-primary">Sửa</button>
        <a href="{{ route('donhang.alldonhang') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
