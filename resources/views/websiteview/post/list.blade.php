@foreach($gallery as $img)
    <div class="col-md-2" id="img_{{ $img->id }}">
        <input type="hidden" name="image_id[]" value="{{  $img->id  }}">

        <img src="{{asset('storage/'.$img->thumb_path )}}" alt="" width="100" height="100">
        <a class="delete-confrim1" data-imgid="{{$img->id}}"
           data-hrefurl="{{ route('user.image.delete', ['id'=>$img->id]) }}" href="#" class="button gray">
            <center><i class="far fa-trash-alt"></i> Delete</center>
        </a>
    </div>
@endforeach

