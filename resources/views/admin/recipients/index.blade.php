@extends('layouts.master')

@section('title', 'Admin Dashboard')
@section('style')
    <link href="{{mix('assets/css/recipient.css')}}" rel="stylesheet"/>
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
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Recipients</a></li>
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
                            <input type="file" class="csv-file-picker" name="csv-file" accept=".xlsx,.csv" data-submit-url="{{route('admin.recipient.file-import')}}" hidden>
                            <button class="btn btn-sm btn-add add-new"><div><i class="fa fa-plus"></i>Add</div></button>
                            <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete</div></button>
                        </div>
                    </div>
                    <div class="add-form-container d-none">
                        <form class="add-form" action="{{route('admin.recipient.add')}}" method="post">
                            @csrf
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 offset-0 col-md-9 offset-md-1">
                                        <div class="row form-item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name (optional) </label>
                                                    <input class="form-control" type="text" name="name[]" placeholder="Recipient Name" >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Phone Number (required) </label>
                                                    <input class="form-control phone-number" type="text" name="phone_number[]" placeholder="Phone Number">
                                                </div>
                                                <div id="phone"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>&nbsp;</label>
                                                <div class="w-100">
                                                    <button class="btn btn-add-more m-btn--square  btn-outline-success m-btn m-btn--custom pull-right" style="width: 120px">
                                                        <i class="fa fa-plus"></i> Add more
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <button type="submit" class="btn m-btn--square create-item  btn-outline-info m-btn m-btn--custom pull-right">
                                                <i class="fa fa-save"></i> Save
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
                                    <th>Country</th>
                                    <th>Phone Number</th>
                                    <th>Tag</th>
                                    <th class="no-search">Subscribed</th>
                                    <th class="action no-sort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recipients as $recipient)
                                    @include('admin.recipients.table-row')
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
                    <div class="text-center w-100 pt-5 px-1">
                        <h4 class=" text-center">Are you really want to submit it?</h4>
                        <div class="col-12 py-4">
                            <div class="col-6 offset-3">
                                <div class="form-group">
                                    <label>Put a tag</label>
                                    <input name="tag" class="form-control"/>
                                </div>
                            </div>
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
    <script src="{{asset('assets/js/recipient.js')}}"></script>
@endsection
