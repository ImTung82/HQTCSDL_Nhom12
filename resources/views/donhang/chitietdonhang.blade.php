@extends('layouts.menu')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
    <h1 class="mb-4">Chi Tiết Đơn Hàng</h1>
    
    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Đơn giá bán</th>
                <th>Tỷ lệ Giảm Giá</th> <!-- Thêm cột tỷ lệ giảm giá -->
                <th>Giá Sau Giảm</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
                <th>Hành Động</th> <!-- Cột hành động -->
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->IDSanPham }}</td>
                    <td>{{ $detail->TenSanPham }}</td>
                    <td>{{ number_format($detail->DonGiaBan, 3) }}</td>
                    <td>{{ number_format($detail->TyLeGiamGia * 100, 2) }}%</td> <!-- Hiển thị tỷ lệ giảm giá -->
                    <td>{{ number_format($detail->GiaSauGiam, 3) }}</td>
                    <td>{{ $detail->SoLuong }}</td>
                    <td>{{ number_format($detail->ThanhTienSanPham, 3) }}</td>

                    <!-- Cột hành động với nút sửa và nút xóa -->
                    <td>
                        <a href="{{ route('spdonhang.edit', ['id' => $detail->IDSanPham, 'donHangId' => $detail->IDDonHang]) }}" class="btn btn-warning btn-sm">
                            Sửa
                        </a>
                        
                        <!-- Nút xóa -->
                        <form action="{{ route('spdonhang.destroy', ['id' => $detail->IDSanPham, 'donHangId' => $detail->IDDonHang]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị tổng tiền -->
    <div class="alert alert-info">
        <strong>Tổng Tiền: </strong>{{ number_format($totalAmount->ThanhTien, 3) }}$
    </div>
@endsection
