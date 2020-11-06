<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$message->id}}"/></td>
    <td>{{$message->name??''}}</td>
    <td>{{$message->username}}</td>
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
