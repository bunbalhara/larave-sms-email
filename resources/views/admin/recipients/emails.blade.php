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
                    <span class="m-nav__link-text">Emails</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Emails</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="crud-table">
                <div class="table-wrapper">
                    <div class="tool-bar">
                        <div class="tool-container">
                            <a href="{{route('admin.recipient.index',['tab'=>'email'])}}" class="btn btn-sm btn-outline-danger"><div><i class="fa fa-arrow-left"></i>Back</div></a>
                            <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete messages</div></button>
                        </div>
                    </div>
                    <div class="dataTables_wrapper">
                        <div class="table-responsive">
                            <table id="message-detail-table" class="table dt-responsive nowrap dataTable no-footer collapsed">
                                <thead>
                                <tr>
                                    <th class="index no-sort">No</th>
                                    <th class="select no-sort"><input type="checkbox" class="select-all"></th>
                                    <th>From</th>
                                    <th>Content</th>
                                    <th>Date</th>
                                    <th class="action no-sort">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                    <tr>
                                        <td class="index"></td>
                                        <td><input type="checkbox" class="select-item" data-id="{{$email->id}}"/></td>
                                        <td>
                                            <div>{{$email->from??''}}</div>
                                        </td>
                                        <td>{!! $email->content !!}</td>
                                        <td><div><div>{{date('Y-m-d h:m:s', strtotime($email->created_at??time()))}}</div></div></td>
                                        <td>
                                            <div class="w-100 d-flex justify-content-around align-items-center">
                                                <button class="btn btn-sm btn-delete delete-item" data-id="{{$email->id}}">
                                                    <div><i class="fa fa-trash"></i>Delete</div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
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
            });
        })
    </script>
@endsection
