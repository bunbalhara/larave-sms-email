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
                            <a href="{{route('admin.message.index')}}" class="btn btn-sm btn-outline-danger"><div><i class="fa fa-arrow-left"></i>Back</div></a>
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
                                    <th>Sender</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Error</th>
                                    <th class="action no-sort">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td class="index"></td>
                                        <td><input type="checkbox" class="select-item" data-id="{{$message->id}}"/></td>
                                        <td>
                                            <div>{{$message->sender_number??''}}</div>
                                            <div>({{$message->sender_name??'-'}})</div>
                                        </td>
                                        <td>{{$message->content}}</td>
                                        <td><span class="@if($message->status=='delivered') text-success @elseif($message->status=='pending') text-warning @else text-danger @endif">{{$message->status??''}}</span></td>
                                        <td>{!! $message->error_code?'<a href="https://www.twilio.com/docs/api/errors/'.$message->error_code.'" target="_blank" class="text-danger">Error:'.$message->error_code.'</a>':'-' !!}</td>
                                        <div>{{date('Y-m-d h:m:s', strtotime($message[0]->delivered??time()))}}</div>
                                        <td>
                                            <div class="w-100 d-flex justify-content-around align-items-center">
                                                <button class="btn btn-sm btn-delete delete-item" data-id="{{$message->id}}">
                                                    <div><i class="fa fa-trash"></i> Delete</div>
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
                deleteUrl:'{{route('admin.message.delete-message')}}',
            });
        })
    </script>
@endsection
