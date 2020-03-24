<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function getDanhsach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    public function getThemDanhsach(){

    }

    public function postTinTuc(Request $request){

    }

    public function getSua($id){

    }
    public function postSua(Request $request, $id){

    }
    public function getXoa($id){

    }
}
