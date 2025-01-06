<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuanLySanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allSanPham()
    {
        $products = DB::table('SanPham')->get();

        return view('sanpham.allsanpham', compact('products'));
    }

    public function chiTietSanPham(string $id)
    {
        $product = DB::table('v_SanPhamChiTiet')->where('IDSanPham', $id)->first();
        return view('sanpham.chitietsanpham', compact('product'));
    }

    public function sanPhamBanChay()
{
    // Lấy danh sách sản phẩm bán chạy từ view v_SanPhamBanChay
    $bestProducts = DB::table('v_SanPhamBanChay')->get();

    // Trả về view với dữ liệu sản phẩm bán chạy
    return view('sanpham.spbanchay', compact('bestProducts'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhaCungCapList = DB::table('NhaCungCap')->get();
        $loaiHangList = DB::table('LoaiHang')->get();
        
        return view('sanpham.create', compact('nhaCungCapList', 'loaiHangList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenSanPham' => 'required|string|max:255',
            'IDNhaCungCap' => 'required|exists:NhaCungCap,IDNhaCungCap',
            'IDLoaiHang' => 'required|exists:LoaiHang,IDLoaiHang',
            'SoLuongCon' => 'required|integer|min:0',
            'DonGiaNhap' => 'required|numeric|min:0',
            'DonGiaBan' => 'required|numeric|min:0',
            'TyLeGiamGia' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::table('SanPham')->insert([
        'IDSanPham' => $request->IDSanPham, 
        'TenSanPham' => $request->TenSanPham,
        'IDNhaCungCap' => $request->IDNhaCungCap,
        'IDLoaiHang' => $request->IDLoaiHang,
        'SoLuongCon' => $request->SoLuongCon,
        'DonGiaNhap' => $request->DonGiaNhap,
        'DonGiaBan' => $request->DonGiaBan,
        'TyLeGiamGia' => $request->TyLeGiamGia / 100,
    ]);
    return redirect()->route('sanpham.create')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('SanPham')->where('IDSanPham', $id)->first();
        $nhaCungCapList = DB::table('NhaCungCap')->get();
    $loaiHangList = DB::table('LoaiHang')->get();
        return view('sanpham.edit', compact('product','nhaCungCapList','loaiHangList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenSanPham' => 'required|string|max:255',
            'IDNhaCungCap' => 'required|exists:NhaCungCap,IDNhaCungCap',
            'IDLoaiHang' => 'required|exists:LoaiHang,IDLoaiHang',
            'SoLuongCon' => 'required|integer|min:0',
            'DonGiaNhap' => 'required|numeric|min:0',
            'DonGiaBan' => 'required|numeric|min:0',
            'TyLeGiamGia' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::table('SanPham')->where('IDSanPham', $id)->update([
            'IDSanPham' => $request->IDSanPham, 
        'TenSanPham' => $request->TenSanPham,
        'IDNhaCungCap' => $request->IDNhaCungCap,
        'IDLoaiHang' => $request->IDLoaiHang,
        'SoLuongCon' => $request->SoLuongCon,
        'DonGiaNhap' => $request->DonGiaNhap,
        'DonGiaBan' => $request->DonGiaBan,
        'TyLeGiamGia' => $request->TyLeGiamGia / 100,
        ]);

        return redirect()->route('sanpham.allsanpham')->with('success', 'Cập nhật sản phẩm thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('SanPham')->where('IDSanPham', $id)->delete();
        return redirect()->route('sanpham.allsanpham')->with('success', 'Xóa sản phẩm thành công.');

    }
}
