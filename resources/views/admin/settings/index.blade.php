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
                    <span class="m-nav__link-text">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports">Setting</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">
            <div class="col-12">
                <form id="setting-form" action="{{route('admin.setting.set')}}" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Twilio Account SID</label>
                                <input type="text"  value="{{option('twilio_account_sid','')}}" name="twilio_account_sid" class="form-control" placeholder="Twilio Account SID"/>
                            </div>
                            <div class="form-group">
                                <label>Twilio Account Token</label>
                                <input type="text"  value="{{option('twilio_account_token','')}}"  name="twilio_account_token" class="form-control" placeholder="Twilio Account Token"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Select Sender</label>
                                <select class="form-control" name="current_sender">
                                    @foreach($senders as $sender)
                                        <option value="{{$sender->id}}" {{option('current_sender','')==$sender->id?'selected':''}}>{{$sender->number}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="w-100 mt-4">
                                <button type="submit" class="btn m-btn--square create-item  btn-outline-info m-btn m-btn--custom pull-right">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function (){
            console.log('setting')
            $('#setting-form').submit(function (e){
                e.preventDefault();
                let formData = new FormData(this);
                window.pAjax($(this).attr('action'), formData, res=>{
                    if(res.status){
                        itoastr('success', 'Saved Successfully!');
                    }
                })
            })
        })
    </script>
@endsection
