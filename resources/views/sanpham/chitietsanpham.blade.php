@extends('layouts.menu')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container mt-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Chi Tiết Sản Phẩm</h1>
    <a href="{{ route('sanpham.allsanpham') }}" class="btn btn-secondary">Quay Lại</a>
</div>


        <div class="row">
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Thông Tin Sản Phẩm
                    </div>
                    <div class="card-body">
                        <p><strong>ID Sản Phẩm:</strong> {{ $product->IDSanPham }}</p>
                        <p><strong>Tên Sản Phẩm:</strong> {{ $product->TenSanPham }}</p>
                        <p><strong>Số Lượng Còn:</strong> {{ $product->SoLuongCon }}</p>
                        <p><strong>Trạng Thái:</strong> 
                            @if ($product->TrangThai === 'Hết hàng')
                <span style="color: red; font-weight: bold;">{{ $product->TrangThai }}</span>
            @elseif ($product->TrangThai === 'Sắp hết hàng')
                <span style="color: orange; font-weight: bold;">{{ $product->TrangThai }}</span>
            @elseif ($product->TrangThai === 'Còn hàng')
                <span style="color: green; font-weight: bold;">{{ $product->TrangThai }}</span>
            @else
                <span style="color: gray;">Không xác định</span>
            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Thông tin nhà cung cấp -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        Thông Tin Nhà Cung Cấp
                    </div>
                    <div class="card-body">
                        <p><strong>Tên Nhà Cung Cấp:</strong> {{ $product->TenNhaCungCap }}</p>
                        <p><strong>Địa Chỉ:</strong> {{ $product->DiaChiNhaCungCap }}</p>
                        <p><strong>Số Điện Thoại:</strong> {{ $product->SDTNhaCungCap }}</p>
                    </div>
                </div>
            </div>

            <!-- Thông tin loại hàng -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        Loại Hàng
                    </div>
                    <div class="card-body">
                        <p><strong>Loại Hàng:</strong> {{ $product->TenLoaiHang }}</p>
                        <p><strong>Mô Tả:</strong> {{ $product->MoTaLoaiHang }}</p>
                    </div>
                </div>
            </div>

            <!-- Thông tin giá -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        Thông Tin Giá
                    </div>
                    <div class="card-body">
                        <p><strong>Đơn Giá Nhập:</strong> {{ number_format($product->DonGiaNhap, 0) }} $</p>
                        <p><strong>Đơn Giá Bán:</strong> {{ number_format($product->DonGiaBan, 0) }} $</p>
                        <p><strong>Tỷ Lệ Giảm Giá:</strong> {{ number_format($product->TyLeGiamGia * 100,0) }}%</p>
                        <p><strong>Giá Sau Giảm:</strong> {{ number_format($product->GiaSauGiam, 0) }} $</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
