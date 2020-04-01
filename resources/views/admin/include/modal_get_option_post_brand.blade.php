
@if(isset($brand) && count($brand))


            <div class="form-group">
                <label>Brand </label>
                <select
                    style="width:100% !important;"
                    class="form-control brands"
                    id="brand"
                    name="brand">
                    <option value="">Select Brand</option>
                    @foreach($brand as $key=>$record)
                        <option value="{{$record->id}}">{{$record->name}}</option>
                    @endforeach
                </select>

            </div>

@endif









