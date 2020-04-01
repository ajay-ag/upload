{{--		{{dd($userlist)}}--}}

@if(count($userlist)>0)
		@foreach($userlist as $u_key =>$userlist_value)
			<li class="list-group-item p-0 {{$toId == $userlist_value->id ? 'ps-user-dhb':''}} ">
				<a class="col-lg-12  " href="{{url('messages')}}/{{$userlist_value->id}}">
					
				  <img class="responsive" style="max-width:60px;" src="{{ Helper::getUserImage($userlist_value->id)}}" alt="Image Description">&nbsp;
				  &nbsp;
				    @if(isset($chat_notification[$userlist_value->id]))
						<span class="notification_message">{{$userlist_value->name}}</span>
						<span class="notification_count">{{$chat_notification[$userlist_value->id]}}</span>
					@else
						<span>{{$userlist_value->name}}</span>
					@endif
				</a>
			</li>
		@endforeach
		@else
		<li class="list-group-item ">
			<h6 class="tect-center mb-0">You have no chat history</h6>
		</li>
		
@endif





