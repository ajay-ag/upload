@extends('websiteview.layout.app')
@section('title',@$title)
@section('site-block')

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('storage/staticpages/banner_image/'.$static_page->banner_image)}});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center">
                            <h1>{!! $static_page->title ?? '' !!}</h1>
                            <!--  <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by</p> -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
    <style type="text/css">

        .card::-webkit-scrollbar {
            width: 1px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 9px;
            background: rgba(96, 125, 139, 0.99);
        }

        .balon1, .balon2 {
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }

        .balon1 a {
            background: #42a5f5;
            color: #fff !important;
            border-radius: 20px 20px 3px 20px;
            display: block;
            max-width: 75%;
            padding: 7px 13px 7px 13px;
        }

        .balon1:before {

            content: attr(data-is);
            position: absolute;
            right: 15px;
            bottom: -0.8em;
            display: block;
            font-size: .750rem;
            color: rgba(84, 110, 122, 1.0);
        }

        .balon2 a {
            background: #f1f1f1;
            color: #000 !important;
            border-radius: 20px 20px 20px 3px;
            display: block;
            max-width: 75%;
            padding: 7px 13px 7px 13px;
        }

        .balon2:before {
            content: attr(data-is);
            position: absolute;
            left: 13px;
            bottom: -0.8em;
            display: block;
            font-size: .750rem;
            color: rgba(84, 110, 122, 1.0);
        }

        .bg-sohbet:before {

            content: "";
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');
            opacity: 0.06;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            height: 100%;
            position: absolute;

        }

        /* headlines with lines */
        .decorated {
            overflow: hidden;
            text-align: center;
        }

        .decorated > span {
            position: relative;
            display: inline-block;
        }

        .decorated > span:before, .decorated > span:after {
            content: '';
            position: absolute;
            top: 50%;
            border-bottom: 1px solid #939393;
            width: 592px; /* half of limiter */
            margin: 0 20px;
        }

        .decorated > span:before {
            right: 100%;
        }

        .decorated > span:after {
            left: 100%;
        }

        #chat_message_history {
            background-image: url('{{asset('storage/default/abc.png')}}');
            max-height: 500px;
            min-height : 300px ;
            overflow: auto;
            background-color: #ffffff;
        }

        #chat_message_history .reverse {
            justify-content: flex-end;
        }

        #chat_message_history label, #chat_message_history img {
            margin-bottom: .2rem !important;
            background-color: #fff;
            padding: 5px;
            font-size: 0.7em;
        }

        #chat_message_history span {
            font-size: 0.7em;

        }

        #chat_message_history .reverse label {
            background-color: #cfd8dc;
            padding: 5px;
        }

        #chat_message_history img {
            border-radius: 50%;
        }

        #online_users li {
            background-color: #fcfcfc;
        }

        #online_users img, .current_chat_user img {
            border-radius: 50%;
            margin: 2%;
        }

        #online_users li a .notification_message {
            color: green;
        }

        .notification_count {
            margin-left: 5%;
            padding: 0px 5px 0px 5px;
            background-color: grey;
            border-radius: 50%;
            color: #fff;
            size: 8px;
        }

        .message_date {
            justify-content: center;
            background-color: #eceff1 !important;
        }

        .message_date label {
            /* background-color: #f6f6f6;   */
            margin: 1%;
            background-color: #eceff1 !important;

        }
        .ps-user-dhb {
            background-color: #424242 !important;
        }
    </style>
    <div class="ps-main-banner">
        <div class="ps-banner-img3">
            <div class="ps-dark-overlay2">
                <div class="containers ">
                    <div class="ps-banner-contentv3 jumbotron text-center p-5">
                        <h4 class="mb-0 font-weight-bolder">It’s Never Too Late To Start</h4>
                        <p class="mb-0"><a href="{{url('/')}}">Home</a> <span><i class="fa fa-angle-right"></i></span> Chat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER START -->
    <!-- MAIN START -->
    <main class="ps-main">
        <!-- MOTIVE START -->
        <section class="container">
            <div class="row" style="align-items: top; justify-content: space-between">
                <div class="col-lg-4">
                    <div class="ps-dashboard-sidebar">

                        <ul class="list-group">
                            <li class="list-group-item active">
                                <h5>Chat History</h5>
                            </li>
                            <li class="list-group-item border-0 p-0">
                                <ul id="online_users" class="list-group p-0">
                                    @if($online_user!="")
                                        {!! $online_user !!}
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 ps-dashboard-user   mb-5">
                    <div class="ps-posted-ads ps-profile-setting card card-body shadow border-0">
                        <div style="background-color: #f38181" class="ps-posted-ads__heading ">
                            <div class="row col-lg-12  current_chat_user">
                                @if($toId!="")
                                    <img class="responsive " src="{{ Helper::getUserImage($toId)}}"
                                        alt="Image Description" style="width: 50px;" >
                                @endif

                                @if(!empty($to_user_detail))

                                    <label style="margin-top:4%;">{{$to_user_detail->name}}</label>
                                @else
                                    <label style="margin-top:1%;padding-left:15px;color:white;">Send Message</label>
                                @endif

                            </div>
                        </div>
                        @if(!empty($advertise_detail))
                            <div class="row ps-profile-setting__content">
                                <div class="col-lg-2">
                                    <img src="{{ $advertise_detail->image_path}}" width="100" height="50"
                                         alt="Image Description">
                                </div>
                                <div class="col-lg-8">
                                    <label>{{$advertise_detail->title}}</label>
                                </div>
                                <div class="col-lg-2 post_price">

                                    ₹ {{Helper::moneyFormatIndiaCommon($advertise_detail->price)}}
                                </div>
                            </div>
                        @endif
                        <div class="ps-profile-setting__content">
                            <!-- POST NEW AD FORM START -->
                            <div class="row">
                                <div class="col-lg-12">
                                <ul class=" border" id="chat_message_history">
                                    @if($chat_message!="")
                                        {!!$chat_message!!}
                                    @endif
                                </ul>
                            </div>
                            </div>
                            <div class="row" style="margin-top: 25px;">
                                <div class="col-md-12">
                                    <div class="form-group ps-fullwidth">
                                        @if($toId!="")
                                            <input
                                                rows="3" maxlength="500"
                                                class="mw-100 border form-control"
                                                id="message_send"
                                                name="message_send"
                                                placeholder="Send Message..."
                                            >
                                            {{--                                            <input id="text" class=" rounded form-control" type="text" name="text" title="Type a message..." placeholder="Type a message..." required>--}}
                                        @else
                                            <label>Select a chat to view conversation</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <!-- MOTIVE END -->
    </main>

@endsection

@section('js')
    <script type="text/javascript">
        var message = [];
        var post_id ={{$advertise_detail->id?? 0}};
        var set_timer = 0;
        var afterdate = $('#after_date').val();
        $(document).ready(function () {
            $("#chat_message_history").scrollTop($("#chat_message_history")[0].scrollHeight);
            // current_online_user();
            set_timer = setInterval(current_online_user, 1000);
        });

        function current_online_user() {
            $.ajax({
                url: "{{ url('online_users')}}",
                method: "POST",
                data: {
                    toId:{{$send_user_id??0}},
                    afterdate: afterdate,
                    post_id: post_id,
                    "_token": "{{ csrf_token() }}",
                },
            })
            .always(function (res) {
                $('#message_send').removeAttr("disabled", false);
                $('#message_send').focus();
            })
            .done(function (result) {

                if (!result.errors) {
                    
                    jQuery.each(result.item, function (item, val) {
                        message.push(val);
                    });
                    
                    if (message[message.length - 1]) {
                        afterdate = message[message.length - 1].dateSent;
                        post_id = message[message.length - 1].post_id;
                    }

                    //   console.log(afterdate);
                    
                    $('#online_users').html(result.online_user);
                    
                    $('#chat_message_history').append(result.chat_message);

                    if (result.item.length > 0){
                        $("#chat_message_history").scrollTop($("#chat_message_history")[0].scrollHeight);
                    }

                } else{
                    console.log("Something is Wrong!");
                }
            });

        }

        $('#message_send').keypress(function (e) {

                if (e.keyCode == 13) {

                    if ($(this).index() == 0) {

                        $('#message_send').attr("disabled", true);
                        var send_user_id ={{$send_user_id??0}};
                        var send_message = $('#message_send').val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });

                        $.ajax({
                            url: "{{ url('messages-send')}}",
                            method: "POST",
                            data: {
                                send_user_id: send_user_id,
                                send_message: send_message,
                                post_id: post_id,
                                "_token": "{{ csrf_token() }}",
                            },
                        })
                        .always(function(res){
                            $('#message_send').removeAttr("disabled");
                        })
                        .done(function (result) {
                            if (!result.errors) {
                                $('#message_send').val('');
                                $('#message_send').focus();
                            } else{
                                console.log("Somethigs is wrong!");
                            }
                        });

                    } 

                }
        });


    </script>
@endsection
