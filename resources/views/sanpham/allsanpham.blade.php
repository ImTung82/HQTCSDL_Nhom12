@extends('layouts.menu')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1 class="mb-4">Danh sách sản phẩm</h1>

    <a href="{{ route('sanpham.updateslsp') }}" class="btn btn-primary mb-4">Cập nhật thông tin</a>

     @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng Còn</th>
                <th>Đơn Giá Bán</th>
                <th>Tỷ Lệ Giảm Giá</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <a href="{{ route('sanpham.chitietsanpham', $product->IDSanPham)}}" class="text-primary text-decoration-none">
                            {{ $product->IDSanPham }}
                        </a>
                        
                    </td>
                    <td>{{ $product->TenSanPham }}</td>
                    <td>{{ $product->SoLuongCon }}</td>
                    <td>{{ number_format($product->DonGiaBan, 3) }}$</td>
                    <td>{{ number_format($product->TyLeGiamGia * 100,0) }}%</td>
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
                    <td>
                        <!-- Nút sửa -->
                        <a href="{{ route('sanpham.edit', $product->IDSanPham) }}" class="btn btn-sm btn-warning">Sửa</a>
                        
                        <!-- Nút xóa -->
                        <form action="{{ route('sanpham.destroy', $product->IDSanPham) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection


