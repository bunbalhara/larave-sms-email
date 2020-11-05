<tr>
    <td class="index"></td>
    <td><input type="checkbox" class="select-item" data-id="{{$sender->id}}"/></td>
    <td>{{$sender->name}}</td>
    <td>{{$sender->number}}</td>
    <td>{{$sender->comment}}</td>
    <td>0</td>
    <td>{!! option('current_sender') == $sender->id?'<span class="badge badge-success">Selected</span>':'' !!}</td>
    <td>
        <div class="w-100 d-flex justify-content-around align-items-center">
            <button class="btn btn-sm btn-edit edit-item" data-id="{{$sender->id}}">
                <div><i class="fa fa-edit"></i>Edit</div>
            </button>
            <button class="btn btn-sm btn-delete delete-item" data-id="{{$sender->id}}">
                <div><i class="fa fa-trash"></i>Delete</div>
            </button>
        </div>
    </td>
</tr>
