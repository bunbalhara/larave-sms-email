<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$message->id}}"/></td>
    <td>{{$message->sender->number??''}}</td>
    <td>
        <div class="d-flex align-items-center position-relative" style="width: 100px; height: 50px;">
        @foreach($message->receivers() as $i => $receiver)
                <div class="position-absolute" style="width: 50px; height: 50px; left: {{30 * $i}}px; top: 0;">
                    <img src="{{$receiver->avatar()}}" class="m--img-rounded m--marginless m--img-centered" alt="avatar" style="width: 100%; height: 100%; object-fit: contain"/>
                </div>
        @endforeach
        </div>
    </td>
    <td>{{$message->content??''}}</td>
    <td>{{date('Y-m-d h:m:s', strtotime($message->delivered??time()))}}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$message->id}}">
                <div><i class="fa fa-trash"></i> Delete</div>
            </button>
        </div>
    </td>
</tr>
