<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuanLyDonHangController;
use App\Http\Controllers\QuanLyNhanVienController;
use App\Http\Controllers\SPDonHangController;
use App\Http\Controllers\QuanLySanPhamController;
use App\Http\Controllers\QuanLyKhachHangController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/donhang/soluongdaban', [QuanLyDonHangController::class, 'slDaBan'])->name('donhang.sldaban');

Route::get('/donhang/alldonhang', [QuanLyDonHangController::class, 'allDonHang'])->name('donhang.alldonhang');

Route::get('/donhang/alldonhang/{id}', [QuanLyDonHangController::class, 'chiTietDonHang'])->name('donhang.chitietdonhang');

Route::get('/donhang/tong-gia-tri-don-hang-theo-tung-ngay', [QuanLyDonHangController::class, 'tongGiaTriCacDonHang'])->name('donhang.tonggiatricacdonhang');

Route::get('/donhang/loi-nhuan-tung-ngay', [QuanLyDonHangController::class, 'tinhLoiNhuanTheoNgay'])->name('donhang.tinhloinhuantheongay');

Route::get('/donhang/create', [QuanLyDonHangController::class, 'create'])->name('donhang.create');

Route::post('/donhang/store', [QuanLyDonHangController::class, 'store'])->name('donhang.store');

Route::get('/donhang/{id}/edit', [QuanLyDonHangController::class, 'edit'])->name('donhang.edit');

Route::put('/donhang/{id}', [QuanLyDonHangController::class, 'update'])->name('donhang.update');

Route::delete('/donhang/{id}', [QuanLyDonHangController::class, 'destroy'])->name('donhang.destroy');

Route::get('/sp-donhang/create', [SPDonHangController::class, 'create'])->name('spdonhang.create');

Route::post('/sp-donhang', [SPDonHangController::class, 'store'])->name('spdonhang.store');

Route::get('/get-available-products', [SPDonHangController::class, 'getAvailableProducts']);

Route::get('/spdonhang/edit/{id}/{donHangId}', [SPDonHangController::class, 'edit'])->name('spdonhang.edit');

Route::put('/spdonhang/update/{id}', [SPDonHangController::class, 'update'])->name('spdonhang.update');

Route::delete('/spdonhang/{id}/{donHangId}', [SPDonHangController::class, 'destroy'])->name('spdonhang.destroy');

Route::get('/nhanvien/allnhanvien', [QuanLyNhanVienController::class, 'allNhanVien'])->name('nhanvien.allnhanvien');

Route::get('/nhanvien/create', [QuanLyNhanVienController::class, 'create'])->name('nhanvien.create');

Route::post('/nhanvien/store', [QuanLyNhanVienController::class, 'store'])->name('nhanvien.store');

Route::get('/nhanvien/{id}/edit', [QuanLyNhanVienController::class, 'edit'])->name('nhanvien.edit');

Route::put('/nhanvien/{id}', [QuanLyNhanVienController::class, 'update'])->name('nhanvien.update');

Route::delete('/nhanvien/{id}', [QuanLyNhanVienController::class, 'destroy'])->name('nhanvien.destroy');

Route::get('/nhanvien/chucvu', [QuanLyNhanVienController::class, 'showChucVu'])->name('nhanvien.chucvu');

Route::get('/nhanvien/tienthuong', [QuanLyNhanVienController::class, 'showTienThuong'])->name('nhanvien.tienthuong');

Route::get('/nhanvien/thongkeluong', [QuanLyNhanVienController::class, 'showLuongThang'])->name('nhanvien.thongkeluong');

Route::get('/khachhang/allkhachang', [QuanLyKhachHangController::class, 'showAllKhachHang'])->name('khachhang.allkhachhang');

Route::get('/khachhang/thanthiet', [QuanLyKhachHangController::class, 'showKhachHangThanThiet'])->name('khachhang.allkhachhangthanthiet');

Route::get('/khachhang/create', [QuanLyKhachHangController::class, 'create'])->name('khachhang.create');

Route::post('/khachhang/store', [QuanLyKhachHangController::class, 'store'])->name('khachhang.store');

Route::get('/khachhang/edit/{id}', [QuanLyKhachHangController::class, 'edit'])->name('khachhang.edit');

Route::put('/khachhang/update/{id}', [QuanLyKhachHangController::class, 'update'])->name('khachhang.update');

Route::delete('/khachhang/delete/{id}', [QuanLyKhachHangController::class, 'destroy'])->name('khachhang.destroy');

Route::get('/khachhang/updatekhtt', [QuanLyKhachHangController::class, 'updateThongTinKHTT'])->name('khachhang.updatekhachhangthanthiet');

Route::get('/sanpham/allsanpham',[QuanLySanPhamController::class,'allSanPham'])->name('sanpham.allsanpham');

Route::get('/sanpham/allsanpham/{id}', [QuanLySanPhamController::class, 'chiTietSanPham'])->name('sanpham.chitietsanpham');

Route::get('/sanpham/sanphambanchay',[QuanLySanPhamController::class, 'sanPhamBanChay'])->name('sanpham.spbanchay');

Route::get('/sanpham/create',[QuanLySanPhamController::class, 'create'])->name('sanpham.create');

Route::post('/sanpham/store', [QuanLySanPhamController::class, 'store'])->name('sanpham.store');

Route::get('/sanpham/{id}/edit', [QuanLySanPhamController::class, 'edit'])->name('sanpham.edit');

Route::put('/sanpham/{id}', [QuanLySanPhamController::class, 'update'])->name('sanpham.update');

Route::delete('/sanpham/{id}', [QuanLySanPhamController::class, 'destroy'])->name('sanpham.destroy');

Route::get('/sanpham/updateslsp',[QuanLySanPhamController::class, 'updateSLSP'])->name('sanpham.updateslsp');

Route::get('/sanpham/timkiem', [QuanLySanPhamController::class, 'find'])->name('sanpham.timkiemsanpham');