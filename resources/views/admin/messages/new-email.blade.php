@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('style')
    <style>
        .table tr.selected{
            background-color: #0a6aa1;
        }
        .note-editable{
            padding: 10px!important;
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
                    <span class="m-nav__link-text">New Email</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">New Email</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card rounded mt-4">
                            <div class="card-header">
                                <h4>Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Tag</label>
                                                <select class="form-control" id="pick-tag">
                                                    <option value="all">All</option>
                                                    @foreach($tags as $tag)
                                                        @if($tag && $tag != "-")
                                                            <option value="{{$tag}}">{{$tag}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="responsive">
                                    <table class="table" id="user-table">
                                        <thead>
                                        <tr>
                                            <th class="no-search no-sort"><input type="checkbox" class="select-all"/></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Tag</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recipients as $recipient)
                                            <tr class="">
                                                <td><input type="checkbox" class="select-item" data-id="{{$recipient->id}}"/></td>
                                                <td>{{$recipient->name??''}}</td>
                                                <td>{{$recipient->email}}</td>
                                                <td>{{$recipient->tag??''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card rounded mt-4">
                            <div class="card-header rounded-top"><h4>Send new email</h4></div>
                            <div class="card-body">
                                <div class="col-12 pt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>From address</label>
                                                <input class="form-control" name="from" value="{{option('mail_from','')}}" placeholder="From Address"/>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input name="subject" class="form-control" placeholder="Subject"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea name="message" class="summernote" id="summernote"></textarea>
                                            </div>
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
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                let tag = $('#pick-tag').val();
                if(tag === 'all'){
                    return  true
                }else {
                    return  data[3].includes(tag)
                }
            }
        );


        $(document).ready(function (){
            let ids = [];
            let rows = [];

            $("#summernote").summernote({
                height: 250,
                callbacks: {
                    onImageUpload: function(files) {
                        let data = new FormData();
                        for (let file of files){
                            data.append("file[]", file);
                        }
                        pAjax("{{route('admin.message.email-upload-image')}}", data, res=>{
                            if(res.status){
                                for (let path of res.data.paths){
                                    let image = $('<img>').attr('src', path).addClass("img-fluid");
                                    $('#summernote').summernote("insertNode", image[0]);
                                }
                            }
                        })
                    }
                }
            })

            let table = $('#user-table').dataTable({
                order:[],
                columnDefs: [
                    {targets: 'no-sort', orderable: false,},
                    {targets: 'no-search', searchable: false,},
                ],
            })

            $(document).on('change', '#pick-tag', function (){
                table.fnDraw();
            })


            $('.select-all').change(function (){
                let filteredRows = table.$('tr', {"filter":"applied"});
                filteredRows.each((index, item)=>{
                    $(item).find('.select-item').prop('checked', $(this).prop('checked'))
                })
                checkSelectedItems();
            })

            $('.select-item').change(function (){
                checkSelectedItems();
            })

            function checkSelectedItems(){
                ids = [];
                rows = [];
                table.fnGetNodes().forEach((item)=>{
                    if($(item).find('.select-item').prop('checked')){
                        ids.push($(item).find('.select-item').data('id'));
                        rows.push($(item));
                        $(item).addClass('selected')
                    }else {
                        $(item).removeClass('selected')
                    }
                })
            }

            $('.submit-message').click(function (e){
                e.preventDefault();
                let formData = new FormData();
                formData.append('receivers', ids.join(','))
                formData.append('message', $('[name="message"]').val())
                formData.append('from', $('[name="from"]').val())
                formData.append('subject', $('[name="subject"]').val())
                let html = $(this).html();
                $(this).loading();
                pAjax('{{route('admin.message.email-send')}}', formData, res=>{
                    console.log(res)
                    if(res.status){
                        itoastr('success', res.message)
                    }
                    $(this).loading(false, html);
                })
            })
            $('.clear-message').click(function (){
                $('textarea[name="message"]').val('')
            })
        })
    </script>
@endsection
