@extends('layouts.menu')

@section('title', 'Thêm Sản Phẩm vào Đơn Hàng')

@section('content')
    <div class="container">
        <h1>Thêm Sản Phẩm vào Đơn Hàng</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('spdonhang.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="IDDonHang" class="form-label">Chọn Đơn Hàng</label>
                <select name="IDDonHang" id="IDDonHang" class="form-control" onchange="fetchProducts(this.value)">
                    <option value="">Chọn Đơn Hàng</option>
                    @foreach($donHangs as $donHang)
                        <option value="{{ $donHang->IDDonHang }}">
                            {{ $donHang->IDDonHang }} - {{ $donHang->TenKhachHang }} (ID: {{ $donHang->IDKhachHang }})
                        </option>
                    @endforeach
                </select>
                @error('IDDonHang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="IDSanPham" class="form-label">Chọn Sản Phẩm</label>
                <select name="IDSanPham" id="IDSanPham" class="form-control" onchange="updatePrice()">
                    <option value="">Chọn sản phẩm</option>
                    @foreach($sanPhams as $sanPham)
                        @if(!in_array($sanPham->IDSanPham, $existingProducts)) <!-- Chỉ hiển thị sản phẩm chưa có trong đơn hàng -->
                            <option value="{{ $sanPham->IDSanPham }}" data-price="{{ $sanPham->DonGiaBan }}" data-discount="{{ $sanPham->TyLeGiamGia }}" data-name="{{ $sanPham->TenSanPham }}">
                                {{ $sanPham->IDSanPham }} - {{ $sanPham->TenSanPham }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('IDSanPham')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="GiaBan" class="form-label">Giá Bán</label>
                <input type="text" id="GiaBan" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="TyLeGiamGia" class="form-label">Tỷ Lệ Giảm Giá</label>
                <input type="text" id="TyLeGiamGia" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="SoLuong" class="form-label">Số Lượng</label>
                <input type="number" name="SoLuong" id="SoLuong" class="form-control" min="1" value="1" onchange="updatePrice()" required>
                @error('SoLuong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ThanhTien" class="form-label">Thành Tiền</label>
                <input type="number" name="ThanhTien" id="ThanhTien" class="form-control" step="0.01" min="0" readonly>
                @error('ThanhTien')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm vào Đơn Hàng</button>
        </form>
    </div>

    <script>
        function fetchProducts(idDonHang) {
            // Gửi request AJAX đến server để lấy sản phẩm chưa có trong đơn hàng
            fetch('/get-available-products?IDDonHang=' + idDonHang)
                .then(response => response.json())
                .then(data => {
                    // Xóa các sản phẩm hiện có
                    var select = document.getElementById("IDSanPham");
                    select.innerHTML = '<option value="">Chọn sản phẩm</option>';  // Reset

                    // Thêm các sản phẩm mới vào dropdown
                    data.forEach(function(product) {
                        var option = document.createElement("option");
                        option.value = product.IDSanPham;
                        option.innerHTML = product.IDSanPham + ' - ' + product.TenSanPham;
                        option.setAttribute("data-price", product.DonGiaBan);
                        option.setAttribute("data-discount", product.TyLeGiamGia);
                        select.appendChild(option);
                    });
                });
        }

        function updatePrice() {
            var select = document.getElementById("IDSanPham");
            var price = select.options[select.selectedIndex].getAttribute("data-price");
            var discount = select.options[select.selectedIndex].getAttribute("data-discount");
            var quantity = document.getElementById("SoLuong").value;

            // Cập nhật giá bán và tỷ lệ giảm giá
            document.getElementById("GiaBan").value = price;
            document.getElementById("TyLeGiamGia").value = (discount * 100).toFixed(2) + '%';

            // Tính giá sau giảm giá
            var priceAfterDiscount = price * (1 - discount);

            // Tính thành tiền
            var total = priceAfterDiscount * quantity;
            document.getElementById("ThanhTien").value = total.toFixed(2);
        }
    </script>
@endsection
