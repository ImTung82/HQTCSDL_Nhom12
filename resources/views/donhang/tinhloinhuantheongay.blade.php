@extends('layouts.menu')

@section('title', 'Lợi Nhuận Theo Ngày')

@section('content')
    <h1 class="mb-4">Lợi Nhuận Theo Ngày</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Ngày</th>
                <th>Lợi Nhuận</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profitData as $row)
                <tr>
                    <td>{{ $row['Ngay'] }}</td>
                    <td>{{ number_format($row['LoiNhuan'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection