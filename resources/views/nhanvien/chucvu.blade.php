@extends('layouts.menu')

@section('title', 'Chức Vụ Nhân Viên')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Chức Vụ Nhân Viên</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Nhân Viên</th>
                <th>Họ Tên</th>
                <th>Số Năm Làm Việc</th>
                <th>Chức Vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['IDNhanVien'] }}</td>
                    <td>{{ $row['HoTen'] }}</td>
                    <td>{{ $row['SoNamLamViec'] }}</td>
                    <td>{{ $row['ChucVu'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
