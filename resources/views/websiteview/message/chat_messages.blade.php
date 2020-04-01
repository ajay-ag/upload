@if(count($chat_message)>0)

 @php
   if($after!="")
       $previews_date=date('d/m/Y',$after);
   else
       $previews_date='';
  @endphp

@foreach($chat_message as $chat_key =>$chat_message_val)
      @if($previews_date!=date('d/m/Y',$chat_message_val->dateSent))
{{--        <li class="row col-lg-12 message_date"><label>----------------------------------------------------------- {{date('d/m/Y',$chat_message_val->dateSent)}} ---------------------------------------------</label></li>--}}
        <h6 class="decorated">
            <span>{{date('d/m/Y',$chat_message_val->dateSent)}}</span>
        </h6>
      @php $previews_date=date('d/m/Y',$chat_message_val->dateSent); @endphp
      @endif
     @if($chat_message_val->userId==$userid)
        <!-- <li class="row col-lg-12 reverse">
        <figure>
          <img src="{{ Helper::getUserImage($chat_message_val->userId)}}" alt="Image Description">
        </figure>
          </li> -->
           @if($chat_message_val->post_name!="" && $chat_message_val->post_price!="")
          <li class="row col-lg-12 reverse"><label>{{$chat_message_val->post_name??''}}
            @if(isset($chat_message_val->post_price))
             ₹ {{Helper::moneyFormatIndiaCommon($chat_message_val->post_price)}}
            @endif
          </label></li>
          @endif
         <div class="balon1 p-2 m-0 position-relative">
             <a class="float-right"> {{$chat_message_val->messageText}} </a>
         </div>
          <li class="row col-lg-12  reverse ">
            {{--  <label>{{$chat_message_val->messageText}}</label>--}}
          </li>  <!--  <li class="row col-lg-12 reverse">
            <span>{{date('d/m/Y',$chat_message_val->dateSent)}}</span>
          </li> -->
        @else
        <!-- <li class="row col-lg-12">
             <figure>
                <img src="{{ Helper::getUserImage($chat_message_val->userId)}}" alt="Image Description">
              </figure>
          </li> -->
          @if($chat_message_val->post_name!="" && $chat_message_val->post_price!="")
         <li class="row col-lg-12"><label>{{$chat_message_val->post_name??''}}
           @if(isset($chat_message_val->post_price))
             ₹ {{Helper::moneyFormatIndiaCommon($chat_message_val->post_price)}}
            @endif
         </label></li>
         @endif
{{--          <li class="row col-lg-12">--}}
{{--            <label>{{$chat_message_val->messageText}}</label>--}}
{{--           </li>--}}
        <div style="overflow: auto;" class="balon2 p-2 m-0 position-relative" >
            <a class="float-left sohbet2">{{$chat_message_val->messageText}}</a>
        </div>
           <!--  <li class="row col-lg-12">
              <span>{{date('d/m/Y',$chat_message_val->dateSent)}}</span>
          </li> -->
     @endif

 @if($loop->last)
     <input type="hidden"  name="after_date" id="after_date" value="{{$chat_message_val->dateSent}}">
 @endif

@endforeach
@endif

