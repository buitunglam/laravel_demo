@extends('admin.layout.index');
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" id="TheLoai">
                                <option>Chọn thể loại</option>
                                @foreach($theloai as $tl)
                                    <option value="{{$tl -> id}}">{{$tl -> Ten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" id="LoaiTin">
                                <option>Chọn loại tin</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="txtCateName" name="TieuDe" placeholder="Nhập tiêu đề"/>
                        </div>

                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo" name="TomTat" class="form-control" rows="3" ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo"  name="NoiDung" class="form-control ckeditor" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="Hinh" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="0" checked="" type="radio">Không nổi bật
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="1" type="radio">Nổi bật
                            </label>
                        </div>

                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    @section('script')
        <script>
            $(document).ready(function(){
                $('#TheLoai').change(function(){
                    let idTheLoai = $(this).val();
                    $.get('admin/ajax/loaitin/'+idTheLoai, function(data){
                        $('#LoaiTin').html(data);
                    });
                });
            });
        </script>
    @endsection
@endsection
