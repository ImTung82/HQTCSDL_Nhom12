<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuanLyKhachHangController extends Controller
{
    public function showAllKhachHang()
    {
        // Lấy dữ liệu từ view vw_allKhachHang
        $khachHangData = DB::table('vw_allKhachHang')->get();

        // Trả dữ liệu vào view
        return view('khachhang.allkhachhang', ['khachHangData' => $khachHangData]);
    }

    public function showKhachHangThanThiet()
    {
        // Lấy dữ liệu từ view vw_KhachHangThanThiet
        $khachHangThanThietData = DB::table('vw_KhachHangThanThiet')->get();

        // Trả dữ liệu vào view
        return view('khachhang.allkhachhangthanthiet', ['khachHangThanThietData' => $khachHangThanThietData]);
    }

    // Hiển thị form thêm khách hàng
    public function create()
    {
        return view('khachhang.create');
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'IDKhachHang' => 'required|string|max:50',
            'HoTen' => 'required|string|max:255',
            'NgaySinh' => 'nullable|date',
            'GioiTinh' => 'nullable|string|max:5',
            'DiaChi' => 'nullable|string|max:255',
            'Email' => 'nullable|email|max:255',
            'SoDienThoai' => 'required|digits:10',
        ]);
    
        // Bắt đầu giao dịch
        DB::beginTransaction();
    
        try {
            // Thêm khách hàng vào cơ sở dữ liệu
            DB::table('KhachHang')->insert($validatedData);
    
            // Xác nhận giao dịch nếu không có lỗi
            DB::commit();
    
            // Trả về thông báo thành công
            return redirect()->route('khachhang.create')->with('success', 'Khách hàng mới đã được thêm thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback nếu có lỗi
            DB::rollBack();
    
            // Kiểm tra mã lỗi SQL Server
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 50000) {
                return redirect()->route('khachhang.create')->with('error', 'Khách hàng đã tồn tại trong hệ thống, không cần tạo lại.');
            }
    
            // Trả về thông báo lỗi chung nếu lỗi không phải từ trigger
            return redirect()->route('khachhang.create')->with('error', 'Thêm khách hàng không thành công. Vui lòng thử lại.');
        }
    }
    
    
    // Hiển thị form sửa khách hàng
    public function edit($id)
    {
        $khachHang = DB::selectOne("SELECT * FROM KhachHang WHERE IDKhachHang = ?", [$id]);
        return view('khachhang.edit', compact('khachHang'));
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'HoTen' => 'required|max:255',
            'NgaySinh' => 'nullable|date',
            'GioiTinh' => 'nullable|in:Nam,Nữ',
            'DiaChi' => 'nullable|max:255',
            'Email' => 'nullable|email|max:255',
            'SoDienThoai' => 'nullable|regex:/^[0-9]{10}$/',
        ]);

        DB::update(
            "UPDATE KhachHang SET HoTen = ?, NgaySinh = ?, GioiTinh = ?, DiaChi = ?, Email = ?, SoDienThoai = ? WHERE IDKhachHang = ?",
            [
                $request->input('HoTen'),
                $request->input('NgaySinh'),
                $request->input('GioiTinh'),
                $request->input('DiaChi'),
                $request->input('Email'),
                $request->input('SoDienThoai'),
                $id,
            ]
        );

        return redirect()->route('khachhang.allkhachhang')->with('success', 'Thông tin khách hàng đã được cập nhật.');
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        DB::delete("DELETE FROM KhachHang WHERE IDKhachHang = ?", [$id]);

        return redirect()->route('khachhang.allkhachhang')->with('success', 'Khách hàng đã được xóa thành công.');
    }

    public function updateThongTinKHTT()
    {
        DB::statement('EXEC sp_CapNhatMucDoThanThiet');

        DB::statement('EXEC sp_TongTienKhachHangDaMua');

        return redirect()->route('khachhang.allkhachhangthanthiet');
    }
}
