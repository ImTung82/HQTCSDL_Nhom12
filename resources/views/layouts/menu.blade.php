<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Lý Đơn Hàng')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm Bootstrap Icons từ CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 15px;
            font-size: 1.5rem;
            font-weight: bold;
            background-color: #495057;
            color: #fff;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 1rem;
        }
        .menu-btn:hover {
            background-color: #6c757d;
            color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .menu-icon {
            font-size: 1.8rem;
            margin-right: 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 12px;
            padding: 10px;
            border-radius: 5px;
            background-color: #343a40;
            transition: background-color 0.3s, padding-left 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
            padding-left: 15px;
        }
        .dropdown {
            margin-bottom: 1rem;
        }
        .dropdown-menu {
            background-color: #343a40;
        }
        .dropdown-item:hover {
            background-color: #495057;
        }
        .custom-divider-icon {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 10px 0;
            color: #6c757d;
            font-size: 14px;
        }

        .custom-divider-icon::before,
        .custom-divider-icon::after {
            content: '';
            flex-grow: 1;
            border-top: 1px solid #6c757d;
        }

        .custom-divider-icon::before {
            margin-right: 0;
        }

        .custom-divider-icon::after {
            margin-left: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar Menu -->
    <div class="sidebar">
        <!-- Nút Trang chủ -->
        <a href="{{ route('index') }}" class="btn menu-btn">
            Trang Chủ
        </a>

        <div class="dropdown mb-3">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false">
                Quản lý sản phẩm
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a class="dropdown-item" href="{{route('sanpham.create')}}">Thêm sản phẩm mới</a></li>
                <li><a class="dropdown-item" href="{{route('sanpham.timkiemsanpham')}}">Tìm kiếm sản phẩm</a></li>
                <li><div class="custom-divider-icon"></div></li>
                <li><a class="dropdown-item" href="{{ route('sanpham.allsanpham')}}">Danh sách sản phẩm</a></li>
                <li><a class="dropdown-item" href="{{ route('sanpham.spbanchay')}}">Danh sách sản phẩm bán chạy</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                Quản lý khách hàng
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a class="dropdown-item" href="{{ route('khachhang.create') }}">Thêm khách hàng mới</a></li>
                <li><div class="custom-divider-icon"></div></li>
                <li><a class="dropdown-item" href="{{ route('khachhang.allkhachhang') }}">Danh sách khách hàng</a></li>
                <li><a class="dropdown-item" href="{{ route('khachhang.allkhachhangthanthiet') }}">Danh sách khách hàng thân thiết</a></li>       
            </ul>
        </div>
 
        <div class="dropdown mb-3">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">
                Quản lý đơn hàng
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                <li><a class="dropdown-item" href="{{ route('donhang.create') }}">Thêm đơn hàng mới</a></li>
                <li><a class="dropdown-item" href="{{ route('spdonhang.create') }}">Thêm sản phẩm vào đơn hàng</a></li>
                <li><div class="custom-divider-icon"></div></li>
                <li><a class="dropdown-item" href="{{ route('donhang.alldonhang') }}">Danh sách đơn hàng</a></li>
                <li><a class="dropdown-item" href="{{ route('donhang.sldaban') }}">Số lượng đã bán của từng sản phẩm</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu5" data-bs-toggle="dropdown" aria-expanded="false">
                Quản lý nhân viên
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu5">
                <li><a class="dropdown-item" href="{{ route('nhanvien.create') }}">Thêm nhân viên mới</a></li>
                <li><div class="custom-divider-icon"></div></li>
                <li><a class="dropdown-item" href="{{ route('nhanvien.allnhanvien') }}">Danh sách nhân viên</a></li>
                <li><a class="dropdown-item" href="{{ route('nhanvien.chucvu') }}">Chức vụ nhân viên</a></li>
                <li><a class="dropdown-item" href="{{ route('nhanvien.tienthuong') }}">Tiền thưởng của nhân viên theo năm</a></li>
            </ul>
        </div>

        <div class="dropdown mb-3">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">
                Thống kê
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                <li><a class="dropdown-item" href="{{ route('donhang.tonggiatricacdonhang') }}">Tổng giá trị của các đơn hàng theo từng ngày</a></li>
                <li><a class="dropdown-item" href="{{ route('donhang.tinhloinhuantheongay') }}">Lợi nhuận theo từng ngày</a></li>
                <li><div class="custom-divider-icon"></div></li>
                <li><a class="dropdown-item" href="{{ route('nhanvien.thongkeluong') }}">Lương của nhân viên theo tháng</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
