<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="source/css/bootstrap.min.css">
<style>
    body, html {
        height: 100%;
        margin: 0;
    }


    .linkWeb{

        color: white;
    }
    a.linkWeb:hover {
        color: #0a90eb;
        text-decoration: none;
    }

    .bgimg {
        background-image: url('source/images/event/bground.jpg');
        height: 100%;
        background-position: center;
        background-size: cover;
        position: relative;
        color: white;
        font-family: "Courier New", Courier, monospace;
        font-size: 25px;
        font-weight: bold;

    }

    .topleft {
        position: absolute;
        top: 0;
        left: 16px;
    }

    .bottomleft {
        position: absolute;
        bottom: 0;
        left: 16px;
    }

    .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .event{
        position: absolute;
        top: 55%;
        left: 55%;
        transform: translate(-50%, -50%);
        text-align: center;

    }

    hr {
        display: block;
        border-style: inset;
        border-width: 1px;
        border-color: white;
        width: 40%;
    }

    /*---------------Css phần thẻ lixi----------------*/


    /*div {*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*}*/

        .lixi {

            width: 150px;
            height: 200px;
            perspective: 500px;
            margin:10px;



        }

        .card {
            transition: transform 1s;
            transform-style: preserve-3d;
            cursor: pointer;
            border: 0px;




        }

        .front, .back {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            backface-visibility: hidden;
            border-radius: 10px;

        }

        .front {

            background: url("source/images/event/lixi.jpg");
            width: 150px;
            height: 200px;


        }


        .back {

            background: url("source/images/event/back_lixi.jpg");


            transform: rotateY(180deg);
            width: 150px;
            height: 200px;
        }


.front:hover {

    cursor: pointer;
  box-shadow: 0px 0px 20px 1px #0a90eb;
}
.back:hover {
    cursor: pointer;

}

    </style>


    <body>


        <div class="bgimg">  {{-- background tổng--}}


            @if(Auth::check())

            <input type="hidden" data-time_sever="{{$time_sever}}" data-deadline="{{$deadline}}" id="result">




            <div class="topleft">
                <a class="linkWeb" href="{{route('trang-chu')}}">

                 Về trang chủ </a>


            </div>
            <div style="width: 535px; margin: 0px auto;padding-top: 50px;">
                    <h1 style="font-weight: bold;">Event bốc thăm may mắn</h1>

                </div>

<div id="close_event">
    <div class="middle">
        <h1 style="font-weight: bold">COMING SOON</h1>
        <hr>
        <p id="demo" style="font-size:30px"></p>

    </div>

    <div class="bottomleft">
        <p> Hãy đợi lượt tiếp theo</p>
    </div>
</div>

<div id="start_event">

       <div  class="event row" style=" width: 75%" >
{{--        $list_reward này ta dùng View Share , để hiện các phần quà ra cho có lệ thôi chứ khi người dùng click vào thì--}}
{{--            sẽ gọi ajax đến sever để lấy 1 kết quả random khác nên việc người dùng F12 là ko vấn đề gì--}}
            @foreach($list_reward as $reward)
                <div class="lixi " >
                    <div class="card">
                        <div class="front">

                        </div>

                            <div class="back">
                                <span class="text-warning" style="font-size: 24px;margin:5px"> {{$reward->noidung}}</span>
                            </div>





                    </div>
                </div>

            @endforeach

            </div>

                  <div  class="bottomleft">
        <span id="thongbao" class="badge badge-light"></span>
    </div>

</div>






       <script language="javascript">

        $(document).ready(function () {


            //lưu ý là  mili time bên PHP ít hơn JavaScript 1000 lần. Ko nên gửi miliseconds từ bên PHP qua
            //mà gửi nguyên cái Date sang rồi dùng Date.parse ép kiểu sang miliseconds
            var time_sever =Date.parse(  $('#result').data('time_sever') ); //lưu ý time_sever này chỉ là lúc mới load trang mới sử dụng
            var deadline = Date.parse(  $('#result').data('deadline') );


            //1 lưu ý là các chức năng kia ta chỉ đang làm khi người dùng đang online trong thời điểm deadline hết hạn
            //nếu deadline hết hạn trong thời gian người dùng đang off thì khi người dùng online trở lại ta phải startEvent lại

            if(deadline-time_sever>0){
                countdown(deadline-time_sever);
               closeEvent();

            }
            else{
                //mặc dù hết deadline là reload trang nhưng hàm startEvent này vẫn cần.
                //1 là để chuyển mode ON thành OFF , 2 là ẩn cái COMMING SOON và show cái event ra
                //vì mặc định nếu ko có javascript là 2 cái đó đều đang show.
                startEvent();
            }

            function flip(element){

                if (element.className === "card") {
                    if(element.style.transform == "rotateY(180deg)") {
                        element.style.transform = "rotateY(0deg)";
                    }
                    else {
                        element.style.transform = "rotateY(180deg)";
                    }
                }
            };


            $(document).on('click', '.card', function(event){
                var element = event.currentTarget; //element là object đang được chọn
                flip(element);


                $.ajax({
                    url: "{{route('sukien')}}",
                    success: function (data) {


                        $(element).find('.front').css('box-shadow','0px 0px 20px 1px #edde34'); //đổi màu bóng thẻ đang chọn
                        $('.card').click(false); //không cho người dùng click tiếp các thẻ khác


                            $(element).find('span').html(data.event_reward); //set phần quà người dùng nhận được vào thẻ người dùng chọn

                            if (data.event_reward!='Chúc bạn may mắn lần sau') {
                                $('#thongbao').html('Chúc mừng bạn nhận được '+data.event_reward);

                            }


                        setTimeout(function () {

                            var arrCard = document.querySelectorAll(".card"); //lấy ra tất cả các div class card
                            arrCard.forEach(function(item){  //lặp mảng các card với mỗi phần tử là item
                                if(item.style.transform != "rotateY(180deg)") //nếu item đó chưa quay 180 độ
                                flip(item); //quay item đó
                            });




                        },5000);


                        //thực hiện hàm đếm ngược với khoảng cách deadline-time_sever
                        var deadline =Date.parse( data.deadline);
                        var time_sever_ajax = Date.parse( data.time_sever); //lấy time_sever ở thời điểm gọi ajax
                        //trong lúc các hiệu ứng settimeOut đang làm việc thì ta vẫn phải countdown ngầm
                        countdown(deadline-time_sever_ajax);

                        setTimeout(function () {

                            //thời gian đếm ngược bị lệch vài giây là do khoảnh khắc $time_sever + 12 tiếng ở bên sever
                            //thì thời gian ở đây vẫn lấy time_sever lúc vừa load trang


                            closeEvent(deadline-time_sever_ajax);


                        },10000);

                    }



                })


            });


            function closeEvent(){
               $("#start_event").hide();
                $("#close_event").show();

           }
           function startEvent(){
                $.ajax({ //thực hiện Ajax chuyển mode ON thành OFF trong csdl
                    url: "{{route('sukien')}}/?mode=OFF",
                })
               $("#close_event").hide();
               $("#start_event").show();

          }

          function countdown(distance){
            var x = setInterval(function() {



                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                    distance-=1000;

                    if (distance < 0) {
                        clearInterval(x);
                        $('#demo').html('');


                        //nói chung hết countdown thì reload lại trang cho nhanh, đỡ phải xử lý nhiều -_-
                           location.reload();





                    }



                }, 1000);

        }
    });




    </script>




    @else    {{--  nếu không có đăng nhập--}}
    <div class="topleft">
        <a class="linkWeb" href="{{route('trang-chu')}}">  <p>Quay về trang chủ</p> </a>
    </div>
    <div class="middle">

        <p id="demo" style="font-size:30px">Bạn cần đăng nhập để tham gia event</p>
        <hr>
        <a href="{{route('dangnhap')}}" class="linkWeb">  <h1>Đăng nhập</h1>  </a>

    </div>


    @endif

</div>

</body>

</html>


