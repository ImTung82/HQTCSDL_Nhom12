<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Import DB facade
use PDO;

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
}
