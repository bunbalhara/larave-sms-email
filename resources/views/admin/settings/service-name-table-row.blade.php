<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$service['sid']}}"/></td>
    <td>{{$service['friendlyName']}}</td>
    <td>{{$service['sid']}}</td>
    <td>
        @if(count($service['phoneNumbers']) == 0)
            <div class="w-100 text-center text-danger">no phone numbers</div>
        @else
            @foreach($service['phoneNumbers'] as $phoneNumber)
                <div>{{$phoneNumber['phoneNumber']}}</div>
            @endforeach
        @endif
    </td>
    <td>
        @if(count($service['alphaSenders']) == 0)
            <div class="w-100 text-center text-warning">no alpha sender</div>
        @else
            @foreach($service['alphaSenders'] as $alphaSender)
                <div>{{$alphaSender['alphaSender']}}</div>
            @endforeach
        @endif
    </td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-edit edit-item" data-id="{{$service['sid']}}" data-item="{{json_encode($service)}}">
                <div><i class="fa fa-edit"></i> Edit</div>
            </button>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$service['sid']}}">
                <div><i class="fa fa-trash"></i> Delete</div>
            </button>
        </div>
    </td>
</tr>
