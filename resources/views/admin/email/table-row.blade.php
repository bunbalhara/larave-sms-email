<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$email->id}}"/></td>
    <td>
        <div>{{$email->from??''}}</div>
    </td>
    <td>
        @foreach($email->recipients() as $i => $item)
            <div>{{$item}}</div>
            @if($i == 4) @break @endif
        @endforeach
        @if(count($email->recipients()) > 5)
            <span> {{count($email->recipients()) - 5}} recipient more</span>
        @endif
    </td>
    <td>{{$email->subject??''}}</td>
    <td  class="text-center">{!! $email->content??'' !!}</td>
    <td>{{date('Y-m-d h:m:s', strtotime($email->created_at??time()))}}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$email->id}}">
                <div><i class="fa fa-trash"></i>Delete</div>
            </button>
        </div>
    </td>
</tr>
