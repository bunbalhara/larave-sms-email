<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$recipient->id}}"/></td>
    <td><span class="">{{$recipient->name}}</span></td>
    <td>{{$recipient->email}}</td>
    <td>{{$recipient->tag??'-'}}</td>
    <td>{!! $recipient->subscribed?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>' !!}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <a href="{{route('admin.recipient.message',['recipientId'=>$recipient->id])}}" class="btn btn-sm btn-edit view-item mr-1 {{$recipient->message->count()==0?'disabled':''}}" data-id="{{$recipient->id}}">
                <div><i class="fa fa-eye"></i>Emails({{$recipient->message->count()}})</div>
            </a>
            <button class="btn btn-sm btn-edit edit-item mr-1" data-id="{{$recipient->id}}">
                <div><i class="fa fa-trash"></i> Edit </div>
            </button>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$recipient->id}}">
                <div><i class="fa fa-trash"></i> Delete </div>
            </button>
        </div>
    </td>
</tr>
