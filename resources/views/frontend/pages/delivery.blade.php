<form >
    @csrf
    <div class="form-group col-md-3">
        <label>Chọn tỉnh-thành phố</label>
            <select class="form-control choose city" name="city" id="city">
                <option value="">--Chọn tỉnh thành phố--</option>
                @foreach ($city as $ci)
                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group col-md-3">
        <label>Chọn quận huyện</label>
            <select class="form-control province choose" name="province" id="province">
                <option value="">--Chọn quận huyện--</option>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label>Chọn xã phường thị trấn</label>
            <select class="form-control wards" name="wards" id="wards">
                <option value="">--Chọn xã phường--</option>
            </select>
    </div>
    <div class="col-md-3">
        <label>Tính phí</label>
    <button type="button" class="btn calculate_delivery">Tính phí vận chuyển</button>
    </div>
</form>
