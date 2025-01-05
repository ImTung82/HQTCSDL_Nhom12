<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuanLyDonHangController;
use App\Http\Controllers\SPDonHangController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/donhang/soluongdaban', [QuanLyDonHangController::class, 'slDaBan'])->name('donhang.sldaban');

Route::get('/donhang/alldonhang', [QuanLyDonHangController::class, 'allDonHang'])->name('donhang.alldonhang');

Route::get('/donhang/alldonhang/{id}', [QuanLyDonHangController::class, 'chiTietDonHang'])->name('donhang.chitietdonhang');

Route::get('/donhang/tong-gia-tri-don-hang-theo-tung-ngay', [QuanLyDonHangController::class, 'tongGiaTriCacDonHang'])->name('donhang.tonggiatricacdonhang');

Route::get('/donhang/loi-nhuan-tung-ngay', [QuanLyDonHangController::class, 'tinhLoiNhuanTheoNgay'])->name('donhang.tinhloinhuantheongay');

Route::get('/sp-donhang/create', [SPDonHangController::class, 'create'])->name('spdonhang.create');

Route::post('/sp-donhang', [SPDonHangController::class, 'store'])->name('spdonhang.store');

Route::get('/get-available-products', [SPDonHangController::class, 'getAvailableProducts']);

Route::get('/spdonhang/edit/{id}/{donHangId}', [SPDonHangController::class, 'edit'])->name('spdonhang.edit');

Route::put('/spdonhang/update/{id}', [SPDonHangController::class, 'update'])->name('spdonhang.update');

Route::delete('/spdonhang/{id}/{donHangId}', [SPDonHangController::class, 'destroy'])->name('spdonhang.destroy');
