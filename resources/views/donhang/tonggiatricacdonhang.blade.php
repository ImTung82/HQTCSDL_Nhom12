@extends('layouts.menu')

@section('title', 'Tổng Giá Trị Đơn Hàng Theo Ngày')

@section('content')
    <h1 class="mb-4">Tổng Giá Trị Đơn Hàng Theo Ngày</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Ngày</th>
                <th>Tổng Giá Trị</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderValues as $row)
                <tr>
                    <td>{{ $row['Ngay'] }}</td>
                    <td>{{ $row['TongGiaTri'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
