<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TinTucController extends Controller
{
    public function getDanhsach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them', ['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function postTinTuc(Request $request){
        $this->validate($request, [
            'LoaiTin' => 'required',
            'TieuDe' => 'required || min:3 || unique:TinTuc, TieuDe',
            'TomTat' => 'required',
            'NoiDung' => 'required'
        ],[
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.unique' => 'Tiêu đề đã tồn tại',
            'TieuDe.min' => 'Tiêu đề phải có ít nhất 3 ký tự',
            'TomTat.required' => 'Bạn chưa nhập tóm tắt',
            'NoiDung.required' => 'Bạn chưa nhập nội dung'
        ]);

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($request -> hasFile('Hinh'))
        {
            $file = $request->file('Hinh');

            $duoiHinh = $file->getClientOriginalExtension();
            if($duoiHinh !== 'jpg' && $duoiHinh !== 'png' && $duoiHinh !== 'jepg'){
                return redirect('admin/tintuc/them')->with('loianh','Định dạng ảnh không đúng');
            }

            $tenGocHinh = $file->getClientOriginalName();
            $Hinh = Str::random(4).''.$tenGocHinh;
            while (file_exists('upload/tintuc/'.$Hinh))
            {
                $Hinh = Str::random(4).''.$tenGocHinh;
            }
            $file->move('upload/tintuc', $Hinh);
            $tintuc->Hinh = $Hinh;
        } else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm tin thành công');
    }

    public function getSua($id){

    }
    public function postSua(Request $request, $id){

    }
    public function getXoa($id){

    }
}
