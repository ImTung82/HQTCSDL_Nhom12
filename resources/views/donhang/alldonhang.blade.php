@extends('layouts.menu')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <h1 class="mb-4">Danh sách đơn hàng</h1>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Đơn Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Tên Nhân Viên Phụ Trách</th>
                <th>Ngày Tạo Đơn Hàng</th>
                <th>Thành Tiền</th>
                <th>Hành Động</th> <!-- Thêm cột Hành Động -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        <a href="{{ route('donhang.chitietdonhang', $item->IDDonHang) }}">
                            {{ $item->IDDonHang }}
                        </a>
                    </td>
                    <td>{{ $item->TenKhachHang }}</td>
                    <td>{{ $item->TenNhanVienPhuTrach }}</td>
                    <td>{{ $item->NgayTaoDonHang }}</td>
                    <td>{{ number_format($item->ThanhTien, 3) }}$</td>
                    <td>
                        <!-- Nút Sửa -->
                        <a href="{{ route('donhang.edit', $item->IDDonHang) }}" class="btn btn-warning btn-sm">Sửa</a>

                        <!-- Nút Xóa -->
                        <form action="{{ route('donhang.destroy', $item->IDDonHang) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
