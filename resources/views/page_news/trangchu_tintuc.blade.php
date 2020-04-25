@extends('master')
@section('content')


    <div style="font-family: Arial" class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="slide-image" src="source/images/slider/800x300.png" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="source/images/slider/800x300.png" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="source/images/slider/800x300.png" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
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
                        <h2 style="margin-top:0px; margin-bottom:0px;"> Tin tức nổi bật</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        @foreach($tintuc as $tt)
                        <div class="row-item row">
                            <h3>
                                <a >{{$tt->loaitin->theloai->Ten}}</a> |


                                <small><a href="{{route('loaitintuc',$tt->loaitin->id)}}"><i>{{$tt->loaitin->Ten}}</i></a></small>


                            </h3>
                            <div class="col-md-12 border-right">
                                <div class="col-md-3">
                                    <a href="{{route('chitiet_tintuc',$tt->id)}}">
                                        <img style="width: 320px;height: 150px" class="img-responsive" src="source/images/news_tintuc/avatar/{{$tt->Hinh}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-9">
                                    <a href="{{route('chitiet_tintuc',$tt->id)}}"><h3 >{{$tt->TieuDe}}</h3></a>
                                    <p>{{$tt->TomTat}}</p>
                                    <a class="btn btn-primary" style="background-color: #f4d529;color:#242424;border-color:#f4d529" href="{{route('chitiet_tintuc',$tt->id)}}">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>

                            </div>

                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                        {{$tintuc->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    @endsection
