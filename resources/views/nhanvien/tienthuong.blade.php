@extends('layouts.menu')

@section('title', 'Tiền Thưởng Nhân Viên Theo Năm')

@section('content')
<div class="container mt-5">
    <h1>Tiền Thưởng Nhân Viên</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form chọn năm -->
    <form action="{{ route('nhanvien.tienthuong') }}" method="GET" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="nam">Chọn Năm</label>
            <select name="nam" id="nam" class="form-control">
                <option value="">-- Chọn Năm --</option>
                <!-- Các năm có thể lựa chọn -->
                @for($i = 2020; $i <= 2025; $i++)
                    <option value="{{ $i }}" {{ old('nam', $nam) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Xem Tiền Thưởng</button>
    </form>

    <!-- Hiển thị bảng kết quả nếu có dữ liệu -->
    @if(isset($data) && count($data) > 0)
        <h3 class="mb-4">Danh Sách Tiền Thưởng Nhân Viên - Năm {{ $nam }}</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Nhân Viên</th>
                    <th>Họ Tên</th>
                    <th>Số Đơn Hàng</th>
                    <th>Tiền Thưởng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row['IDNhanVien'] }}</td>
                        <td>{{ $row['HoTen'] }}</td>
                        <td>{{ $row['SoDonHang'] }}</td>
                        <td>{{ number_format($row['TienThuong'], 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-warning">Không có dữ liệu cho năm này.</p>
    @endif
</div>
@endsection
