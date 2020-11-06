@extends('layouts.master')

@section('title', 'Admin Dashboard')
@section('style')

@endsection
@section('breadcrumb')
    <div class="mr-auto">
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">/</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Users</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Users</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
           <div class="crud-table">
               <div class="table-wrapper">
                   <div class="tool-bar">
                       <div class="tool-container">
                           <button class="btn btn-sm btn-cancel-add btn-outline-danger d-none"><div><i class="fa fa-arrow-left"></i>Back</div></button>
                           <button class="btn btn-sm btn-outline-info csv-import"><div><i class="fa fa-file-import"></i>Import from CSV</div></button>
                           <input type="file" class="csv-file-picker" name="csv-file" accept=".xlsx,.csv" data-submit-url="{{route('admin.user.file-import')}}" hidden>
                           <button class="btn btn-sm btn-add add-new"><div><i class="fa fa-plus"></i>Add</div></button>
                           <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete</div></button>
                           <button class="btn btn-sm btn-edit edit-all disabled"><div><i class="fa fa-edit"></i>Edit</div></button>
                           <button class="btn btn-sm btn-save save-all disabled"><div><i class="fa fa-save"></i>Save</div></button>
                       </div>
                   </div>
                   <div class="add-form-container d-none">
                       <form class="add-form" action="{{route('admin.user.add')}}" method="post">
                           @csrf
                           <div class="col-12">
                               <div>

                               </div>
                               <div class="row">
                                   <div class="col-lg-6">
                                       <div class="form-group">
                                           <label>Name</label>
                                           <input class="form-control" type="text" name="name" placeholder="Full Name">
                                       </div>
                                       <div class="form-group">
                                           <label>User Name</label>
                                           <input class="form-control" type="text" name="username" placeholder="User Name">
                                       </div>
                                       <div class="form-group">
                                           <label>Phone Number(required)</label>
                                           <input class="form-control" type="tel" name="phone" placeholder="Phone Number">
                                       </div>
                                   </div>
                                   <div class="col-lg-6">
                                       <div class="form-group">
                                           <label>Email</label>
                                           <input class="form-control" type="email" name="email" placeholder="Email">
                                       </div>
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input class="form-control" type="password" name="password" placeholder="Password">
                                       </div>
                                       <div class="form-group">
                                           <label>Password Confirm</label>
                                           <input class="form-control" type="password" name="password_confirm" placeholder="Confirm Password">
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="pull-right">
                                           <button class="btn btn-cancel-add m-btn--square  btn-outline-danger m-btn m-btn--custom">
                                               Cancel
                                           </button>
                                           <button type="submit" class="btn m-btn--square create-item  btn-outline-info m-btn m-btn--custom">
                                               Submit
                                           </button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="dataTables_wrapper">
                       <div class="table-responsive">
                           <table id="users-table" class="table dt-responsive nowrap dataTable no-footer collapsed">
                               <thead>
                               <tr>
                                   <th class="index no-sort">No</th>
                                   <th class="select no-sort"><input type="checkbox" class="select-all"></th>
                                   <th>Name</th>
                                   <th>User Name</th>
                                   <th>Email</th>
                                   <th>Phone Number</th>
                                   <th class="no-search">active</th>
                                   <th class="action no-sort">action</th>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($users as $user)
                                   @include('admin.users.table-row')
                               @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
    <div id="submit-csv-file-dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="delete-modal-content">
                    <div class="w-100 position-absolute" style="top: 20px; right: 20px">
                        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center w-100 d-flex justify-content-around align-items-center py-5 px-1">
                        <div class="d-flex align-items-center">
                            <h6 class="mr-1">Name: </h6>
                            <select name="name" class="select-box">
                                @foreach([1,2,3,4] as $i)
                                    <option value="{{$i-1}}" {{$i==1?'selected':''}}>{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <h6 class="mr-1">Email: </h6>
                            <select name="email" class="select-box">
                                @foreach([1,2,3,4] as $i)
                                    <option value="{{$i-1}}" {{$i==2?'selected':''}}>{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <h6 class="mr-1">Phone number: </h6>
                            <select name="phone" class="select-box">
                                @foreach([1,2,3,4] as $i)
                                    <option value="{{$i-1}}"  {{$i==3?'selected':''}}>{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <h6>Password: </h6>
                            <select name="password" class="select-box">
                                @foreach([1,2,3,4] as $i)
                                    <option value="{{$i-1}}"  {{$i==4?'selected':''}}>{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-outline-info csv-submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $('.crud-table').crud({
                urls:{
                  edit:'{{route('admin.user.edit')}}',
                  update:'{{route('admin.user.update')}}',
                  delete:'{{route('admin.user.delete')}}',
                },
                csvImport: true,
            });
        })
    </script>
@endsection
