<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$user->id}}"/></td>
    <td>{{$user->name}}</td>
    <td>{{$user->username}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->phone}}</td>
    <td>{{$user->active?'Active':'Inactive'}}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-edit edit-item" data-id="{{$user->id}}">
                <div><i class="fa fa-edit"></i> Edit</div>
            </button>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$user->id}}">
                <div><i class="fa fa-trash"></i> Delete</div>
            </button>
        </div>
    </td>
</tr>
