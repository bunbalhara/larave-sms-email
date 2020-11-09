<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$recipient->id}}"/></td>
    <td>{{$recipient->name}}</td>
    <td>{{$recipient->country}} <img src="{{asset('assets/img/flags/'.$recipient->country.'.png')}}"></td>
    <td>{{$recipient->phone_number}}</td>
    <td>{!! $recipient->subscribed?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>' !!}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-edit view-item {{$recipient->messageCount()==0?'disabled':''}}" data-id="{{$recipient->id}}">
                <div><i class="fa fa-eye"></i>Messages({{$recipient->messageCount()}})</div>
            </button>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$recipient->id}}">
                <div><i class="fa fa-trash"></i> Delete</div>
            </button>
        </div>
    </td>
</tr>
