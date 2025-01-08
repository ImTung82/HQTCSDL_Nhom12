@extends('layouts.menu')

@section('title', 'Danh sách nhân viên')

@section('content')
    <h1 class="mb-4">Danh sách nhân viên</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Nhân Viên</th>
                <th>Họ Tên</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Địa Chỉ</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Ngày Bắt Đầu Làm Việc</th>
                <th>Lương Cứng</th>
                <th>Số Năm Làm Việc</th>
                <th>Lương Hiện Tại</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->IDNhanVien }}</td>
                    <td>{{ $item->HoTen }}</td>
                    <td>{{ $item->NgaySinh }}</td>
                    <td>{{ $item->GioiTinh }}</td>
                    <td>{{ $item->DiaChi }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>{{ $item->SoDienThoai }}</td>
                    <td>{{ $item->NgayBatDauLamViec }}</td>
                    <td>{{ number_format($item->LuongCung, 3) }}$</td>
                    <td>{{ $item->SoNamLamViec }}</td>
                    <td>{{ number_format($item->LuongHienTai, 3) }}$</td>
                    <td>
                        <!-- Nút sửa -->
                        <a href="{{ route('nhanvien.edit', $item->IDNhanVien) }}" class="btn btn-sm btn-warning">Sửa</a>
                        
                        <!-- Nút xóa -->
                        <form action="{{ route('nhanvien.destroy', $item->IDNhanVien) }}" method="POST" style="display:inline;">
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
