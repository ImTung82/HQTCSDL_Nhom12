@extends('layouts.menu')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
    <h1 class="mb-4">Tìm kiếm sản phẩm</h1>
    <form action="{{ route('sanpham.timkiemsanpham') }}" method="GET" class="mb-4">
        <!-- Tìm kiếm theo tên sản phẩm -->
        <div class="mb-3">
            <label for="ten_sanpham" class="form-label">Tìm kiếm theo tên sản phẩm:</label>
            <input type="text" name="ten_sanpham" id="ten_sanpham" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('ten_sanpham', $tenSanPham ?? '') }}">
        </div>

        <!-- Dropdown chọn loại hàng -->
        <div class="mb-3">
            <label for="id_loaihang" class="form-label">Chọn loại hàng:</label>
            <select name="id_loaihang" id="id_loaihang" class="form-select">
                <option value="">--Lựa Chọn loại hàng--</option>
                @foreach($loaihang as $lh)
                    <option value="{{ $lh->IDLoaiHang }}" {{ isset($idLoaiHang) && $idLoaiHang == $lh->IDLoaiHang ? 'selected' : '' }}>
                        {{ $lh->TenLoaiHang }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Nút tìm kiếm -->
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <!-- Hiển thị kết quả tìm kiếm -->
    @if(isset($sanpham) && count($sanpham) > 0)
        <h2>Kết quả tìm kiếm:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Tỷ lệ giảm giá</th>
                    <th scope="col">Tình trạng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sanpham as $sp)
                    <tr>
                        <td><a href="{{ route('sanpham.chitietsanpham', $sp->IDSanPham)}}" class="text-primary text-decoration-none">
                            {{ $sp->IDSanPham }}
                        </a></td>
                        <td>{{ $sp->TenSanPham }}</td>
                        <td>{{ number_format($sp->DonGiaBan, 3)}} $</td>
                        <td>{{ number_format($sp->TyLeGiamGia * 100, 0)}}%</td>
                        <td>
                            @if ($sp->TrangThai === 'Hết hàng')
                <span style="color: red; font-weight: bold;">{{ $sp->TrangThai }}</span>
            @elseif ($sp->TrangThai === 'Sắp hết hàng')
                <span style="color: orange; font-weight: bold;">{{ $sp->TrangThai }}</span>
            @elseif ($sp->TrangThai === 'Còn hàng')
                <span style="color: green; font-weight: bold;">{{ $sp->TrangThai }}</span>
            @else
                <span style="color: gray;">Không xác định</span>
            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else

        <p>Không tìm thấy sản phẩm nào!</p>
    @endif
@endsection
