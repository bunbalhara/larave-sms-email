<td class="index no-padding"></td>
<td class="no-padding"> <input type="checkbox" class="select-item" data-id="{{$sender->id}}" disabled/></td>
<td class="no-padding"><input class="input-box" value="{{$sender->name}}" name="name"/></td>
<td class="no-padding"><input class="input-box"  value="{{$sender->number}}" name="number"/></td>
<td class="no-padding"><input class="input-box"  value="{{$sender->comment}}" name="email" type="comment"/></td>
<td class="no-padding"><input  class="input-box"  value="0" disabled/></td>
<td>{!! option('current_sender') == $sender->id?'<span class="badge badge-success">Selected</span>':'' !!}</td>
<td>
    <div class="w-100 d-flex justify-content-around align-items-center">
        <button class="btn btn-sm btn-danger cancel-item" data-id="{{$sender->id}}">
            <div><i class="fa fa-times"></i> Close</div>
        </button>
        <button class="btn btn-sm btn-save update-item" data-id="{{$sender->id}}">
            <div><i class="fa fa-save"></i> Save</div>
        </button>
    </div>
</td>
