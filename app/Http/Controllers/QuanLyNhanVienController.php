<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use PDO;

class QuanLyNhanVienController extends Controller
{
    public function allNhanVien()
    {
        // Sử dụng Query Builder để truy vấn dữ liệu từ View
        $data = DB::table('view_ShowLuongNV')->get();

        return view('nhanvien.allnhanvien', compact('data'));
    }

    // Hiển thị form thêm nhân viên
    public function create()
    {
        return view('nhanvien.create');
    }

    // Xử lý thêm nhân viên
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'IDNhanVien' => 'required|unique:NhanVien,IDNhanVien|max:50',
            'HoTen' => 'required|max:255',
            'NgaySinh' => 'nullable|date',
            'GioiTinh' => 'nullable|max:5',
            'DiaChi' => 'nullable|max:255',
            'Email' => 'required|email|unique:NhanVien,Email|max:255',
            'SoDienThoai' => 'required|digits:10|unique:NhanVien,SoDienThoai',
            'NgayBatDauLamViec' => 'nullable|date',
        ]);

        // Chèn dữ liệu vào bảng NhanVien
        DB::table('NhanVien')->insert([
            'IDNhanVien' => $request->IDNhanVien,
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'DiaChi' => $request->DiaChi,
            'Email' => $request->Email,
            'SoDienThoai' => $request->SoDienThoai,
            'NgayBatDauLamViec' => date('Y-m-d'),
        ]);

        // Chuyển hướng với thông báo thành công
        return redirect()->route('nhanvien.create')->with('success', 'Nhân viên đã được thêm thành công.');
    }

    public function edit($id)
    {
        // Lấy thông tin nhân viên theo ID
        $nhanVien = DB::table('NhanVien')->where('IDNhanVien', $id)->first();

        // Hiển thị form chỉnh sửa
        return view('nhanvien.edit', compact('nhanVien'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'HoTen' => 'required|max:255',
            'NgaySinh' => 'nullable|date',
            'GioiTinh' => 'nullable|max:5',
            'DiaChi' => 'nullable|max:255',
            'Email' => 'required|email|unique:NhanVien,Email,' . $id . ',IDNhanVien',
            'SoDienThoai' => 'required|digits:10|unique:NhanVien,SoDienThoai,' . $id . ',IDNhanVien',
            'NgayBatDauLamViec' => 'nullable|date',
        ]);
    
        // Cập nhật thông tin nhân viên
        DB::table('NhanVien')->where('IDNhanVien', $id)->update([
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'DiaChi' => $request->DiaChi,
            'Email' => $request->Email,
            'SoDienThoai' => $request->SoDienThoai,
            'NgayBatDauLamViec' => $request->NgayBatDauLamViec,
        ]);
    
        // Chuyển hướng với thông báo thành công
        return redirect()->route('nhanvien.allnhanvien')->with('success', 'Cập nhật nhân viên thành công.');
    }

    public function destroy($id)
    {
        // Xóa nhân viên theo ID
        DB::table('NhanVien')->where('IDNhanVien', $id)->delete();
    
        // Chuyển hướng với thông báo
        return redirect()->route('nhanvien.allnhanvien')->with('success', 'Xóa nhân viên thành công.');
    }

    public function showChucVu()
    {        
        $data = [];

        // Kết nối PDO để lấy nhiều kết quả
        $pdo = DB::getPdo();
        $stmt = $pdo->query('EXEC sp_ChucVuNhanVien');

        do {
            // Lấy từng bảng và hợp nhất dữ liệu
            $data = array_merge($data, $stmt->fetchAll(PDO::FETCH_ASSOC));
        } while ($stmt->nextRowset());

        // Trả dữ liệu vào view
        return view('nhanvien.chucvu', ['data' => $data]);
    }
    
    public function showTienThuong(Request $request)
    {
        // Lấy năm từ request
        $nam = $request->input('nam');
    
        // Nếu không có năm trong request, hiển thị thông báo lỗi
        if (!$nam) {
            return view('nhanvien.tienthuong', [
                'data' => [],
                'nam' => null,
                'error' => 'Vui lòng chọn năm trước khi xem tiền thưởng.'
            ]);
        }
    
        $data = [];
    
        // Kết nối PDO để lấy nhiều kết quả từ thủ tục
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('EXEC sp_HienThiTienThuongTheoNam :nam');
        $stmt->bindParam(':nam', $nam, PDO::PARAM_INT);
        $stmt->execute();
    
        // Lấy kết quả từ thủ tục và gộp lại thành một mảng duy nhất
        do {
            $data = array_merge($data, $stmt->fetchAll(PDO::FETCH_ASSOC));
        } while ($stmt->nextRowset());
    
        // Trả dữ liệu vào view
        return view('nhanvien.tienthuong', [
            'data' => $data,
            'nam' => $nam,
            'error' => null
        ]);
    }
    
    public function showLuongThang(Request $request)
    {
        // Lấy năm và tháng từ request
        $nam = $request->input('nam');
        $thang = $request->input('thang');

        // Kiểm tra xem năm và tháng có hợp lệ không
        if (!$nam || !$thang) {
            return view('nhanvien.thongkeluong', [
                'data' => [],
                'nam' => $nam,
                'thang' => $thang,
                'error' => 'Vui lòng chọn cả năm và tháng.'
            ]);
        }

        // Thực hiện gọi thủ tục lưu trữ
        $data = DB::select('EXEC sp_ThongKeLuongThang :nam, :thang', [
            'nam' => $nam,
            'thang' => $thang,
        ]);

        // Trả dữ liệu vào view
        return view('nhanvien.thongkeluong', [
            'data' => $data,
            'nam' => $nam,
            'thang' => $thang,
            'error' => null
        ]);
    }
}
