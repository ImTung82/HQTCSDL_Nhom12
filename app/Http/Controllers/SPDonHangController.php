<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QuanLyKhachHangController;

class SPDonHangController extends Controller
{
    protected $quanLyKhachHangController;

    public function __construct(QuanLyKhachHangController $quanLyKhachHangController)
    {
        $this->quanLyKhachHangController = $quanLyKhachHangController;
    }
    
    public function create()
    {
        // Lấy danh sách đơn hàng, khách hàng từ cơ sở dữ liệu
        $donHangs = DB::table('DonHang')
            ->join('KhachHang', 'DonHang.IDKhachHang', '=', 'KhachHang.IDKhachHang')
            ->select('DonHang.IDDonHang', 'KhachHang.HoTen as TenKhachHang', 'DonHang.IDKhachHang')
            ->get();

        // Lấy danh sách sản phẩm
        $sanPhams = DB::table('SanPham')
            ->select('IDSanPham', 'TenSanPham', 'DonGiaBan', 'TyLeGiamGia')
            ->get();

        // Lấy danh sách sản phẩm đã có trong đơn hàng
        $existingProducts = DB::table('SP_DonHang')
            ->whereIn('IDDonHang', $donHangs->pluck('IDDonHang')->toArray())
            ->pluck('IDSanPham')
            ->toArray();

        return view('spdonhang.create', compact('donHangs', 'sanPhams', 'existingProducts'));
    }

    // Phương thức để lấy danh sách sản phẩm chưa có trong đơn hàng
    public function getAvailableProducts(Request $request)
    {
        $idDonHang = $request->input('IDDonHang');
        
        // Lấy danh sách sản phẩm đã có trong đơn hàng
        $existingProducts = DB::table('SP_DonHang')
            ->where('IDDonHang', $idDonHang)
            ->pluck('IDSanPham')
            ->toArray();
        
        // Lấy danh sách sản phẩm chưa có trong đơn hàng
        $availableProducts = DB::table('SanPham')
            ->whereNotIn('IDSanPham', $existingProducts)
            ->select('IDSanPham', 'TenSanPham', 'DonGiaBan', 'TyLeGiamGia')
            ->get();

        return response()->json($availableProducts);
    }

    public function store(Request $request)
    {
        // Xử lý lưu dữ liệu vào bảng SP_DonHang
        $request->validate([
            'IDDonHang' => 'required',
            'IDSanPham' => 'required',
            'SoLuong' => 'required|integer|min:1',
        ]);

        // Sử dụng hàm fn_GiaBanSauGiam để tính giá bán sau giảm giá
        $giaBanSauGiam = DB::selectOne('SELECT dbo.fn_GiaBanSauGiam(?) AS GiaBanSauGiam', [$request->IDSanPham])->GiaBanSauGiam;

        // Tính thành tiền
        $thanhTien = $giaBanSauGiam * $request->SoLuong;

        // Lưu dữ liệu vào bảng SP_DonHang
        DB::table('SP_DonHang')->insert([
            'IDDonHang' => $request->IDDonHang,
            'IDSanPham' => $request->IDSanPham,
            'SoLuong' => $request->SoLuong,
            'ThanhTien' => $thanhTien
        ]);

        // Gọi phương thức updateThongTinKHTT() từ QuanLyKhachHangController
        $this->quanLyKhachHangController->updateThongTinKHTT();

        return redirect()->route('spdonhang.create')->with('success', 'Thêm sản phẩm vào đơn hàng thành công');
    }

    public function edit($id, $donHangId)
    {
        // Lấy thông tin đơn hàng
        $donHang = DB::table('DonHang')->where('IDDonHang', $donHangId)->first();
        if (!$donHang) {
            return redirect()->route('spdonhang.index')->with('error', 'Đơn hàng không tồn tại.');
        }
    
        // Lấy thông tin sản phẩm trong đơn hàng
        $product = DB::table('SP_DonHang')
            ->join('SanPham', 'SP_DonHang.IDSanPham', '=', 'SanPham.IDSanPham')
            ->select('SP_DonHang.*', 'SanPham.TenSanPham', 'SanPham.DonGiaBan', 'SanPham.TyLeGiamGia')
            ->where('SP_DonHang.IDSanPham', $id)
            ->where('SP_DonHang.IDDonHang', $donHangId)
            ->first();
    
        if (!$product) {
            return redirect()->route('spdonhang.index')->with('error', 'Sản phẩm không tồn tại trong đơn hàng.');
        }
    
        return view('spdonhang.edit', compact('donHang', 'product'));
    }
      
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'SoLuong' => 'required|integer|min:1',
        ]);
    
        // Get the new quantity
        $soLuong = $request->SoLuong;
    
        // Get the product and calculate the price after discount
        $product = DB::table('SanPham')->where('IDSanPham', $id)->first();
        if (!$product) {
            return redirect()->route('spdonhang.index')->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Tính giá bán sau giảm giá
        $giaBanSauGiam = $product->DonGiaBan * (1 - $product->TyLeGiamGia);
        $thanhTien = $giaBanSauGiam * $soLuong;
    
        // Get donHangId from request (not from route)
        $donHangId = $request->donHangId;
    
        // Update the quantity and total price in SP_DonHang table
        DB::table('SP_DonHang')
            ->where('IDSanPham', $id)
            ->where('IDDonHang', $donHangId)
            ->update([
                'SoLuong' => $soLuong,
                'ThanhTien' => $thanhTien,
            ]);
            
        // Gọi phương thức updateThongTinKHTT() từ QuanLyKhachHangController
        $this->quanLyKhachHangController->updateThongTinKHTT();

        // Thêm thông báo thành công vào session và chuyển hướng về trang đơn hàng
        return redirect()->route('donhang.chitietdonhang', ['id' => $donHangId])
                         ->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id, $donHangId)
    {
        // Xóa sản phẩm khỏi đơn hàng
        DB::table('SP_DonHang')
            ->where('IDSanPham', $id)
            ->where('IDDonHang', $donHangId)
            ->delete();
    
        // Gọi phương thức updateThongTinKHTT() từ QuanLyKhachHangController
        $this->quanLyKhachHangController->updateThongTinKHTT();

        // Thêm thông báo thành công vào session và chuyển hướng về trang chi tiết đơn hàng
        return redirect()->route('donhang.chitietdonhang', ['id' => $donHangId])
                         ->with('success', 'Sản phẩm đã được xóa khỏi đơn hàng!');
    }
}