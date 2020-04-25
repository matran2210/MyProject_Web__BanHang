@extends('master')

@section('content')
    <div style="font-family: Arial" class="container">
        <div class="row">
            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active " style=" font-size:20px;background-color: #f4d529;color: #0b0b0b;border-color:#f4d529 ">
                        Danh mục
                    </li>



                    @foreach($theloai as $tl)
                        @if(count($tl->loaitin)>0)
                            <li  class="list-group-item menu1">
                                {{$tl->Ten}}
                            </li>

                            <ul style="margin-left:30px">
                                @foreach($tl->loaitin as $lt)
                                    <li class="list-group-item">
                                        <a href="{{route('loaitintuc',$lt->id)}}">{{$lt->Ten}}</a>
                                    </li>

                                @endforeach
                            </ul>

                        @endif

                    @endforeach


                </ul>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#f4d529; color:#242424;" >

{{--   do $tintuc được truyền sang là 1 mảng nên ta phải truy cập vài 1 phần tử nhất định rồi mới lấy sang quan hệ loaitin được--}}
                        <h2 style="margin-top:0px; margin-bottom:0px;"> Tin tức {{$tenLoaiTin->Ten}}</h2>

                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        @foreach($tintuc_theoloai as $tt)
                            <div class="row-item row">

                                <div class="col-md-12 border-right">
                                    <div class="col-md-3">
                                        <a href="{{route('chitiet_tintuc',$tt->id)}}">
                                            <img style="width: 320px;height: 150px" class="img-responsive" src="source/images/news_tintuc/avatar/{{$tt->Hinh}}" alt="">
                                        </a>
                                    </div>

                                    <div class="col-md-9">
                                        <a href="{{route('chitiet_tintuc',$tt->id)}}" ><h3>{{$tt->TieuDe}}</h3></a>
                                        <p>{{$tt->TomTat}}</p>
                                        <a class="btn btn-primary" style="background-color: #f4d529;color:#242424;border-color:#f4d529" href="{{route('chitiet_tintuc',$tt->id)}}">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                                    </div>

                                </div>

                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                        {{$tintuc_theoloai->links()}}

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
    @endsection
