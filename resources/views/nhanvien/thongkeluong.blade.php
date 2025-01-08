@extends('layouts.menu')

@section('title', 'Thống Kê Lương Nhân Viên')

@section('content')
<div class="container mt-5">
    <h1>Thống Kê Lương Nhân Viên</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if($error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif

    <!-- Form chọn năm và tháng -->
    <form action="{{ route('nhanvien.thongkeluong') }}" method="GET" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nam">Chọn Năm</label>
                    <select name="nam" id="nam" class="form-control">
                        <option value="">-- Chọn Năm --</option>
                        @for($i = 2020; $i <= 2025; $i++)
                            <option value="{{ $i }}" {{ $i == $nam ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="thang">Chọn Tháng</label>
                    <select name="thang" id="thang" class="form-control">
                        <option value="">-- Chọn Tháng --</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == $thang ? 'selected' : '' }}>Tháng {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Thống Kê</button>
    </form>

    <!-- Hiển thị bảng kết quả nếu có dữ liệu -->
    @if(isset($data) && count($data) > 0)
        <h3 class="mb-4">Danh Sách Lương Nhân Viên - Tháng {{ $thang }} / Năm {{ $nam }}</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Nhân Viên</th>
                    <th>Họ Tên</th>
                    <th>Lương Cơ Bản</th>
                    <th>Hoa Hồng</th>
                    <th>Tổng Lương</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row->IDNhanVien }}</td>
                        <td>{{ $row->HoTen }}</td>
                        <td>{{ number_format($row->LuongCoBan, 5) }}$</td>
                        <td>{{ number_format($row->HoaHong, 5) }}$</td>
                        <td>{{ number_format($row->TongLuong, 5) }}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-warning">Không có dữ liệu cho tháng và năm này.</p>
    @endif
</div>
@endsection
