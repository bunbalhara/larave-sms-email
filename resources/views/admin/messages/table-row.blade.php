<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$message[0]->group_id}}"/></td>
    <td>
        <div>{{$message[0]->sender_number??''}}</div>
        <div>({{$message[0]->sender_name??'-'}})</div>
    </td>
    <td>
        @foreach($message as $i => $item)
            <div><img src="{{asset('assets/img/flags/'.strtolower($item->recipient->country).'.png')}}" class="mr-1"> {{$item->recipient->phone_number}}</div>
            @if($i == 4) @break @endif
        @endforeach
        @if(count($message) > 5)
           <span class="text-info"> + {{count($message) - 5}} recipient more</span>
        @endif
    </td>
    <td>{{$message[0]->content??''}}</td>
    <td>{{date('Y-m-d h:m:s', strtotime($message[0]->delivered??time()))}}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$message[0]->group_id}}">
                <div><i class="fa fa-trash"></i> Delete</div>
            </button>
        </div>
    </td>
</tr>
