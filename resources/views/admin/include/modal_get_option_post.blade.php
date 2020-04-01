
<div class="row">


    @foreach($attribute as $key=>$record)


        <div class="col-md-4">
            <div class="form-group">
                <label>{{$record->name ?? ''}} <span class="text-danger">*</label></label>
                <input
                    type="text"
                    class="form-control"
                    id="attr{{$record->id}}"
                    name="grop[{{$record->id}}][attribute_value]"
                    required=""
                >
                <input
                    type="hidden"
                    class="form-control"
                    id="attr{{$record->id}}"
                    name="grop[{{$record->id}}][attribute_name]"
                    required=""
                    value="{{$record->name}}"
                >
                <input
                    type="hidden"
                    class="form-control"
                    id="attr{{$record->id}}"
                    name="grop[{{$record->id}}][attribute_id]"
                    required=""
                    value="{{$record->id}}"
                >
            </div>
        </div>

    @endforeach
</div>




