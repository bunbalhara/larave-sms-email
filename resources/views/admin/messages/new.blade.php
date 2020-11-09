@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('style')
    <style>
        .table tr.selected{
            background-color: #0a6aa1;
        }
    </style>
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
                    <span class="m-nav__link-text">New Message</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">New Message</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card rounded mt-4">
                            <div class="card-header">
                                <h4>Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="responsive">
                                    <table class="table" id="user-table">
                                        <thead>
                                            <tr>
                                                <th class="no-search no-sort"><input type="checkbox" class="select-all"/></th>
                                                <th>Name</th>
                                                <th>Country</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recipients as $recipient)
                                                <tr class="">
                                                    <td><input type="checkbox" class="select-item" data-id="{{$recipient->id}}"/></td>
                                                    <td>{{$recipient->name}}</td>
                                                    <td>{{$recipient->country}} <img src="{{asset('assets/img/flags/'.$recipient->country.'.png')}}"/></td>
                                                    <td>{{$recipient->phone_number}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card rounded mt-4">
                            <div class="card-header rounded-top"><h4>Send SMS message</h4></div>
                            <div class="card-body">
                                <div class="col-12 pt-4">
                                    <div class="row">
                                        <div class="control-label col-lg-4 d-flex align-items-center">Default Sender:</div>
                                        <div class="col-lg-8">
                                            <div class="form-control" id="default_sender">

                                            </div>
                                        </div>
                                        <!-- Default unchecked -->
                                        <div class="col-12 py-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="useOtherSender">
                                                <label class="custom-control-label" for="useOtherSender">Use other sender</label>
                                            </div>
                                        </div>

                                        <div class="w-100 col-12 d-none" id="all-senders">
                                            <div class="row">
                                                <div class="control-label col-lg-4 d-flex align-items-center">Select a sender:</div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="sender">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <div class="form-group">
                                                <label>Message (max 160 characters)</label>
                                                <textarea class="form-control message-box" name="message" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center text-warning pt-4">
                                            <i class="fas fa-exclamation-triangle"></i> <span>Make sure you are set up correct Twilio account credentials and the sender and receiver phone numbers is valid.</span>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <div class="pull-right">
                                                <button class="btn  m-btn--square  btn-outline-danger m-btn m-btn--custom clear-message">
                                                    Clear
                                                </button>
                                                <button type="submit" class="btn m-btn--square create-item btn-outline-info m-btn m-btn--custom submit-message">
                                                    <i class="fa fa-paper-plane "></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let defaultServiceSid = '{{option('default_sender', '')}}';
        if(defaultServiceSid === ''){
            $('#default_sender').html('<span class="text-danger">Default Sender is not defined</span>')
        }else {
            $('#default_sender').html('<div class="w-100 text-center text-info"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></div>')
        }
        $.ajax({
            type:'get',
            url:"{{route('admin.setting.get-services')}}",
            success:res=>{
                if(res.status){
                    let services = res.data.services;
                    for(let service of services){
                        if(service.sid === defaultServiceSid){
                            $('#default_sender').text(service.alphaSenders[0].alphaSender)
                        }

                        $('select[name="sender"]').append(`<option value="${service.sid}">${service.alphaSenders[0].alphaSender}</option>`)
                    }
                }
            },
            error:err=>{
                console.log(err)
            }
        })

        $(document).ready(function (){
            let sender = defaultServiceSid;
            let ids = [];
            let rows = [];

            $('.message-box').bind('input propertychange', function() {
                if($(this).val().length > 160){
                    $(this).invalid();
                }else {
                    $(this).invalid(false)
                }
            });


            $('#useOtherSender').change(function (){
                let checked = $(this).prop('checked');
                $('#default_sender').disable(checked)
                if(checked){
                    $('#all-senders').show()
                    sender = $('#all-senders').find('select').val()
                }else {
                    $('#all-senders').hide();
                    sender = defaultServiceSid;
                }
            })

            $('#all-senders').find('select').change(function (){
                sender = $(this).val();
            })

            $('#user-table').dataTable({
                order:[],
                columnDefs: [
                    {targets: 'no-sort', orderable: false,},
                    {targets: 'no-search', searchable: false,},
                ],
            })

            $('.select-all').change(function (){
                $('.select-item').prop('checked', $(this).prop('checked'))
                checkSelectedItems();
            })

            $('.select-item').change(function (){
                checkSelectedItems();
            })

            function checkSelectedItems(){
                ids = [];
                rows = [];
                $('#user-table').find('.select-item').each((index, item)=>{
                    if($(item).prop('checked')){
                        console.log($(item).data('id'))
                        ids.push($(item).data('id'));
                        rows.push($(item).parents('tr'));
                        $(item).parents('tr').addClass('selected')
                    }else {
                        $(item).parents('tr').removeClass('selected')
                    }
                })
            }

            $('.submit-message').click(function (e){
                e.preventDefault();
                let formData = new FormData();
                formData.append('serviceSid', sender)
                formData.append('receivers', ids.join(','))
                formData.append('message', $('[name="message"]').val())
                let html = $(this).html();
                $(this).loading();
                pAjax('{{route('admin.message.send')}}', formData, res=>{
                    console.log(res)
                    if(res.status){
                        itoastr('success', res.message)
                    }
                    $(this).loading(false, html);
                })
            })
        })
    </script>
@endsection
