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
                    <span class="m-nav__link-text">Messages</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Messages</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="crud-table">
                <div class="table-wrapper">
                    <div class="tool-bar">
                        <div class="tool-container">
                            <a href="{{route('admin.new-message')}}" class="btn btn-sm btn-add"><div><i class="fa fa-paper-plane "></i>Send new message</div></a>
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
                                    <th>Sender</th>
                                    <th>Receivers</th>
                                    <th>Content</th>
                                    <th>Delivered</th>
                                    <th class="action no-sort">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    @include('admin.messages.table-row')
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
                    delete:'{{route('admin.message.delete')}}',
                },
                addable: false,
            });
        })
    </script>
@endsection
