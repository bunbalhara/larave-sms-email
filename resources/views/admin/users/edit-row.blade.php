<td class="index no-padding"></td>
<td class="no-padding"> <input type="checkbox" class="select-item" data-id="{{$user->id}}" disabled/></td>
<td class="no-padding"><input class="input-box" value="{{$user->name}}" name="name"/></td>
<td class="no-padding"><input class="input-box"  value="{{$user->username}}" name="username"/></td>
<td class="no-padding"><input class="input-box"  value="{{$user->email}}" name="email" type="email"/></td>
<td class="no-padding"><input class="input-box"  value="{{$user->phone}}" name="phone" type="tel"/></td>
<td class="no-padding">
    <select class="select-box w-100" name="active">
        <option value="1">Active</option>
        <option value="0" {{$user->active?'':'selected'}}>Inactive</option>
    </select>
</td>
<td>
    <div class="w-100 d-flex justify-content-around align-items-center">
        <button class="btn btn-sm btn-danger cancel-item" data-id="{{$user->id}}">
            <div><i class="fa fa-times"></i> Close</div>
        </button>
        <button class="btn btn-sm btn-save update-item" data-id="{{$user->id}}">
            <div><i class="fa fa-save"></i> Save</div>
        </button>
    </div>
</td>
