<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$recipient->id}}"/></td>
    <td><span class="@if(!$recipient->country) text-danger @endif">{{$recipient->name}}</span></td>
    <td>@if($recipient->country) {{$recipient->country}} <img src="{{asset('assets/img/flags/'.strtolower($recipient->country).'.png')}}"> @else Undefined @endif </td>
    <td>{{$recipient->phone_number}}</td>
    <td>{{$recipient->tag??'-'}}</td>
    <td>{!! $recipient->subscribed?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>' !!}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <a href="{{route('admin.recipient.message',['recipientId'=>$recipient->id])}}" class="btn btn-sm btn-edit view-item {{$recipient->message->count()==0?'disabled':''}}" data-id="{{$recipient->id}}">
                <div><i class="fa fa-eye"></i>Messages({{$recipient->message->count()}})</div>
            </a>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$recipient->id}}">
                <div><i class="fa fa-trash"></i> Delete </div>
            </button>
        </div>
    </td>
</tr>
