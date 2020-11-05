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
                    <span class="m-nav__link-text">Senders</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Senders</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="crud-table">
                <div class="table-wrapper">
                    <div class="tool-bar">
                        <div class="tool-container">
                            <button class="btn btn-sm btn-add add-new"><div><i class="fa fa-plus"></i>Add</div></button>
                            <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete</div></button>
                            <button class="btn btn-sm btn-edit edit-all disabled"><div><i class="fa fa-edit"></i>Edit</div></button>
                            <button class="btn btn-sm btn-save save-all disabled"><div><i class="fa fa-save"></i>Save</div></button>
                        </div>
                    </div>
                    <div class="add-form-container d-none">
                        <form class="add-form" action="{{route('admin.sender.add')}}" method="post">
                            @csrf
                            <div class="col-12">
                                <div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" placeholder="Sender Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" type="tel" name="number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea class="form-control" type="text" name="comment" placeholder="Comments"></textarea>
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
                                    <th>Number</th>
                                    <th>Comments</th>
                                    <th>Sent Messages</th>
                                    <th class="no-search no-sort">Selected</th>
                                    <th class="action no-sort">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($senders as $sender)
                                    @include('admin.senders.table-row')
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    edit:'{{route('admin.sender.edit')}}',
                    update:'{{route('admin.sender.update')}}',
                    delete:'{{route('admin.sender.delete')}}',
                },
            });
        })
    </script>
@endsection
