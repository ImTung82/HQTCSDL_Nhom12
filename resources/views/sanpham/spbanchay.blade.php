@extends('layouts.menu')

@section('title', 'Danh sách sản phẩm bán chạy')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Danh Sách Sản Phẩm Bán Chạy</h1>

        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng Còn</th>
                    <th>Số lượng bán ra</th>
                    <th>Đơn Giá Bán</th>
                    <th>Tỷ Lệ Giảm Giá</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bestProducts as $product)
                    <tr class="text-center">
                        <td>
                            <a href="{{ route('sanpham.chitietsanpham', $product->IDSanPham) }}" class="text-primary text-decoration-none">
                                {{ $product->IDSanPham }}
                            </a>
                        </td>
                        <td>{{ $product->TenSanPham }}</td>
                        <td>{{ $product->SoLuongCon }}</td>
                        <td>{{ $product->SoLuongBanRa}}</td>
                        <td>{{ number_format($product->DonGiaBan, 0) }} $</td>
                        <td>{{ number_format($product->TyLeGiamGia * 100, 0) }}%</td>
                        <td>
                            @if ($product->TrangThai === 'Hết hàng')
                <span style="color: red; font-weight: bold;">{{ $product->TrangThai }}</span>
            @elseif ($product->TrangThai === 'Sắp hết hàng')
                <span style="color: orange; font-weight: bold;">{{ $product->TrangThai }}</span>
            @elseif ($product->TrangThai === 'Còn hàng')
                <span style="color: green; font-weight: bold;">{{ $product->TrangThai }}</span>
            @else
                <span style="color: gray;">Không xác định</span>
            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection




