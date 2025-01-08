<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Import DB facade
use PDO;
use Illuminate\Http\Request;

class QuanLyDonHangController extends Controller
{
    public function slDaBan()
    {
        // Sử dụng Query Builder để truy vấn dữ liệu từ View
        $data = DB::table('v_SLDaBan')->get();

        return view('donhang.sldaban', compact('data'));
    }

    public function allDonHang()
    {
        // Sử dụng Query Builder để truy vấn dữ liệu từ View
        $data = DB::table('v_AllDonHang')->get();

        return view('donhang.alldonhang', compact('data'));
    }

    public function chiTietDonHang($id)
    {
        // Truy vấn dữ liệu chi tiết đơn hàng
        $details = DB::table('vw_ChiTietDonHang')->where('IDDonHang', $id)->get();

        // Tính tổng tiền
        $totalAmount = DB::table('DonHang')->where('IDDonHang', $id)->first();

        // Trả về view chi tiết
        return view('donhang.chitietdonhang', ['details' => $details,  'totalAmount' => $totalAmount]);
    }

    public function tongGiaTriCacDonHang()
    {
        $orderValues = [];

        // Kết nối PDO để lấy nhiều kết quả
        $pdo = DB::getPdo();
        $stmt = $pdo->query('EXEC sp_TinhTongGiaTriDonHangTheoNgay');
    
        do {
            // Lấy từng bảng và hợp nhất dữ liệu
            $orderValues = array_merge($orderValues, $stmt->fetchAll(PDO::FETCH_ASSOC));
        } while ($stmt->nextRowset());

        // Trả về view với dữ liệu
        return view('donhang.tonggiatricacdonhang', compact('orderValues'));
    }

    public function tinhLoiNhuanTheoNgay()
    {
        $profitData = [];

        // Kết nối PDO để thực thi stored procedure
        $pdo = DB::getPdo();
        $stmt = $pdo->query('EXEC sp_TinhLoiNhuanTheoNgay');

        do {
            // Lấy từng bảng và hợp nhất dữ liệu
            $profitData = array_merge($profitData, $stmt->fetchAll(PDO::FETCH_ASSOC));
        } while ($stmt->nextRowset());

        // Trả về view với dữ liệu đã gộp
        return view('donhang.tinhloinhuantheongay', ['profitData' => $profitData]);
    }

    // Hiển thị form thêm đơn hàng
    public function create()
    {
        // Lấy danh sách khách hàng với ID và tên
        $khachHangs = DB::table('KhachHang')
            ->select('IDKhachHang', DB::raw("CONCAT(IDKhachHang, ' - ', HoTen) as KhachHangInfo"))
            ->get();
    
        // Lấy danh sách nhân viên với ID và tên
        $nhanViens = DB::table('NhanVien')
            ->select('IDNhanVien', DB::raw("CONCAT(IDNhanVien, ' - ', HoTen) as NhanVienInfo"))
            ->get();
    
        return view('donhang.create', compact('khachHangs', 'nhanViens'));
    }

    // Lưu đơn hàng vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'IDDonHang' => 'required|string|max:50|unique:DonHang,IDDonHang',
            'IDKhachHang' => 'required|string|exists:KhachHang,IDKhachHang',
            'IDNhanVien' => 'required|string|exists:NhanVien,IDNhanVien',
            'NgayTaoDonHang' => 'required|date',
        ]);

        // Tạo đơn hàng mới
        DB::table('DonHang')->insert([
            'IDDonHang' => $validatedData['IDDonHang'],
            'IDKhachHang' => $validatedData['IDKhachHang'],
            'IDNhanVien' => $validatedData['IDNhanVien'],
            'NgayTaoDonHang' => $validatedData['NgayTaoDonHang'],
            'ThanhTien' => 0, // Khởi tạo ThanhTien = 0
        ]);

        return redirect()->route('donhang.create')->with('success', 'Đơn hàng mới đã được thêm thành công!');
    }

    // Hiển thị form sửa đơn hàng
    public function edit($id)
    {
        $donHang = DB::table('DonHang')->where('IDDonHang', $id)->first();
        $khachHangs = DB::table('KhachHang')
            ->select('IDKhachHang', DB::raw("CONCAT(IDKhachHang, ' - ', HoTen) AS TenKhachHang"))
            ->get();
        $nhanViens = DB::table('NhanVien')
            ->select('IDNhanVien', DB::raw("CONCAT(IDNhanVien, ' - ', HoTen) AS TenNhanVien"))
            ->get();
    
        if (!$donHang) {
            return redirect()->route('donhang.alldonhang')->with('error', 'Đơn hàng không tồn tại.');
        }
    
        return view('donhang.edit', compact('donHang', 'khachHangs', 'nhanViens'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'IDKhachHang' => 'required',
            'IDNhanVien' => 'required',
            'NgayTaoDonHang' => 'required|date',
        ]);

        // Cập nhật thông tin đơn hàng
        DB::table('DonHang')->where('IDDonHang', $id)->update([
            'IDKhachHang' => $request->IDKhachHang,
            'IDNhanVien' => $request->IDNhanVien,
            'NgayTaoDonHang' => $request->NgayTaoDonHang,
        ]);

        return redirect()->route('donhang.alldonhang')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        // Xóa đơn hàng khỏi cơ sở dữ liệu
        DB::table('DonHang')->where('IDDonHang', $id)->delete();

        return redirect()->route('donhang.alldonhang')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}
