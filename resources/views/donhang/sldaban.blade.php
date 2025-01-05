@extends('layouts.menu')

@section('title', 'Thống kê số lượng sản phẩm đã bán')

@section('content')
    <h1 class="mb-4">Thống kê số lượng sản phẩm đã bán</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng Đã Bán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->IDSanPham }}</td>
                    <td>{{ $item->TenSanPham }}</td>
                    <td>{{ $item->SoLuongDaBan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
