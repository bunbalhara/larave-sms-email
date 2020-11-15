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
                    <span class="m-nav__link-text">All Emails</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Sent Emails</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="crud-table">
                <div class="table-wrapper">
                    <div class="tool-bar">
                        <div class="tool-container">
                            <a href="{{route('admin.new-email')}}" class="btn btn-sm btn-add"><div><i class="fa fa-envelope "></i>Send new email</div></a>
                            <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete messages</div></button>
                        </div>
                    </div>
                    <div class="dataTables_wrapper">
                        <div class="table-responsive">
                            <table id="messages-table" class="table dt-responsive nowrap dataTable no-footer collapsed">
                                <thead>
                                <tr>
                                    <th class="index no-sort">No</th>
                                    <th class="select no-sort"><input type="checkbox" class="select-all"></th>
                                    <th>From</th>
                                    <th>Recipients</th>
                                    <th>Subject</th>
                                    <th>content</th>
                                    <th>Sent</th>
                                    <th class="action no-sort">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                    @include('admin.email.table-row')
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
                deleteUrl:'{{route('admin.email.delete')}}',
                addable: false,
            });
        })
    </script>
@endsection
