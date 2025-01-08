@extends('layouts.menu')

@section('title', 'Sửa Sản Phẩm trong Đơn Hàng')

@section('content')
    <div class="container">
        <h1>Sửa Sản Phẩm trong Đơn Hàng</h1>
        
        <form action="{{ route('spdonhang.update', $product->IDSanPham) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Truyền IDDonHang -->
            <input type="hidden" name="donHangId" value="{{ $donHang->IDDonHang }}">

            <div class="mb-3">
                <label for="IDSanPham" class="form-label">Tên Sản Phẩm</label>
                <input type="text" id="IDSanPham" class="form-control" value="{{ $product->TenSanPham }}" readonly>
            </div>

            <div class="mb-3">
                <label for="GiaBan" class="form-label">Giá Bán</label>
                <input type="text" id="GiaBan" class="form-control" value="{{ $product->DonGiaBan }}" readonly>
            </div>

            <div class="mb-3">
                <label for="TyLeGiamGia" class="form-label">Tỷ Lệ Giảm Giá</label>
                <input type="text" id="TyLeGiamGia" class="form-control" value="{{ $product->TyLeGiamGia * 100 }}" readonly>
            </div>

            <div class="mb-3">
                <label for="SoLuong" class="form-label">Số Lượng</label>
                <input type="number" name="SoLuong" id="SoLuong" class="form-control" min="1" value="{{ $product->SoLuong }}" required>
            </div>

            <div class="mb-3">
                <label for="ThanhTien" class="form-label">Thành Tiền</label>
                <input type="number" name="ThanhTien" id="ThanhTien" class="form-control" step="0.01" min="0" value="{{ $product->ThanhTien }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Đơn Hàng</button>
        </form>
    </div>

    <script>
        // Lấy các giá trị từ form
        var giaBan = parseFloat(document.getElementById('GiaBan').value);  // Giá bán sản phẩm
        var tyLeGiamGia = parseFloat(document.getElementById('TyLeGiamGia').value) / 100;  // Tỷ lệ giảm giá
        var thanhTienField = document.getElementById('ThanhTien');

        // Lắng nghe sự thay đổi số lượng
        document.getElementById('SoLuong').addEventListener('input', function () {
            var soLuong = parseInt(this.value);
            if (soLuong >= 1) {
                // Tính toán lại giá sau khi giảm giá
                var giaSauGiam = giaBan * (1 - tyLeGiamGia);  // Giá sau khi áp dụng giảm giá

                // Tính thành tiền
                var thanhTien = giaSauGiam * soLuong;

                // Cập nhật giá trị thành tiền
                thanhTienField.value = thanhTien.toFixed(2);  // Hiển thị đúng định dạng số, không làm tròn
            }
        });
    </script>
@endsection