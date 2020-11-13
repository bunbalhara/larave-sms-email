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
            <li class="tab-item"><a class="tab-link tab-active" data-area="#setting" href="#/setting">General Setting</a></li>
            <li class="tab-item"><a class="tab-link" data-area="#service_names" href="#/service_names">SMS Service Names</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="setting_area">
        <div class="m-portlet__body">
            <div class="col-12">
                <form id="setting-form" action="{{route('admin.setting.set')}}" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <legend>SMS setting:</legend>
                                <div class="form-group">
                                    <label>Twilio Account SID</label>
                                    <input type="text"  value="{{option('twilio_account_sid','')}}" name="twilio_account_sid" class="form-control" placeholder="Twilio Account SID"/>
                                </div>
                                <div class="form-group">
                                    <label>Twilio Account Token</label>
                                    <input type="text"  value="{{option('twilio_account_token','')}}"  name="twilio_account_token" class="form-control" placeholder="Twilio Account Token"/>
                                </div>
                                <div class="form-group">
                                    <label>Default Sender</label>
                                    <select class="form-control" name="default_sender">
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset>
                                <legend>Email setting:</legend>
                                <div class="form-group">
                                    <label>Twilio Account SID</label>
                                    <input type="text"  value="{{option('twilio_account_sid','')}}" name="twilio_account_sid" class="form-control" placeholder="Twilio Account SID"/>
                                </div>
                                <div class="form-group">
                                    <label>Twilio Account Token</label>
                                    <input type="text"  value="{{option('twilio_account_token','')}}"  name="twilio_account_token" class="form-control" placeholder="Twilio Account Token"/>
                                </div>
                                <div class="form-group">
                                    <label>Default Sender</label>
                                    <select class="form-control" name="default_sender">
                                    </select>
                                </div>
                            </fieldset>
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
    <div class="m-portlet m-portlet--mobile tab_area" id="service_names_area">
        <div class="m-portlet__body">
            <div class="col-12">
                <div class="crud-table">
                    <div class="table-wrapper">
                        <div class="tool-bar">
                            <div class="tool-container">
                                <button class="btn btn-sm btn-cancel-add btn-outline-danger d-none"><div><i class="fa fa-arrow-left"></i>Back</div></button>
                                <button class="btn btn-sm btn-add add-new"><div><i class="fa fa-plus"></i>Add</div></button>
                                <button class="btn btn-sm btn-delete delete-all disabled"><div><i class="fa fa-trash"></i>Delete</div></button>
                                <button class="btn btn-sm btn-edit edit-all disabled"><div><i class="fa fa-edit"></i>Edit</div></button>
                                <button class="btn btn-sm btn-save save-all disabled"><div><i class="fa fa-save"></i>Save</div></button>
                            </div>
                        </div>
                        <div class="add-form-container d-none">
                            <form class="add-form" action="{{route('admin.setting.service-name-add')}}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 offset-lg-3">
                                            <div class="form-group">
                                                <label>Service Name</label>
                                                <input class="form-control" type="text" name="service_name" placeholder="Service Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Sender Name</label>
                                                <input class="form-control" type="text" name="service_alias" placeholder="Sender Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <select class="form-control"  name="phone_number" >
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 offset-3 mt-4">
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
                                        <th>Sid</th>
                                        <th>Phone Numbers</th>
                                        <th>Sender Name(alias)</th>
                                        <th class="action no-sort">action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="delete-modal-content">
                    <div class="w-100 position-absolute" style="top: 20px; right: 20px">
                        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="w-100 text-left d-flex justify-content-around align-items-center py-5 px-1">
                        <div class="w-100">
                            <div class="form-group">
                                <label>Service Name</label>
                                <input class="form-control" type="text" name="service_name">
                            </div>
                            <div class="form-group">
                                <div>Sender Name</div>
                                <input class="form-control" type="text" name="service_alias">
                            </div>
                            <div class="form-group phone_numbers">
                                <label>Phone Number</label>
                                <select name="phone_number" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-outline-info update-item">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $.ajax({
            type:'get',
            url:'{{route('admin.setting.get-phone-numbers')}}',
            success:res=>{
                if(res.status){
                    let phoneNumbers = res.data.phoneNumbers;
                    for (let phoneNumber of phoneNumbers){
                        $('select[name="phone_number"]').append(`<option value="${phoneNumber.sid}">${phoneNumber.phoneNumber}</option>`)
                    }
                }
            },
            error:err=>{
                console.log(err)
            }
        })
        let defaultServiceSid = '{{option('default_service', null)}}'
        $.ajax({
            type:'get',
            url:"{{route('admin.setting.get-services')}}",
            success:res=>{
                if(res.status){
                    let services = res.data.services;
                    for(let service of services){
                        $('select[name="default_sender"]').append(`<option value="${service.sid}" ${service.sid===defaultServiceSid?'selected':''}>${service.friendlyName}</option>`)
                    }
                }
            },
            error:err=>{
                console.log(err)
            }
        })

        $(document).ready(function (){

            $('#setting-form').submit(function (e){
                e.preventDefault();
                let formData = new FormData(this);
                window.pAjax($(this).attr('action'), formData, res=>{
                    if(res.status){
                        itoastr('success', 'Saved Successfully!');
                    }
                })
            })

            let crudTable = $('.crud-table').crud({
                editUrl:'{{route('admin.setting.service-name-edit')}}',
                updateUrl:'{{route('admin.setting.service-name-update')}}',
                deleteUrl:'{{route('admin.setting.service-name-delete')}}',
                tableFetchUrl:'{{route('admin.setting.get-services')}}',
                dataTable:false,
                fnEdit:function (obj, editBtn){
                    let service = $(editBtn).data('item');
                    let modal = $('#editModal');
                    modal.modal('show');
                    modal.find('input[name="service_name"]').val(service.friendlyName);
                    modal.find('input[name="service_alias"]').val(service.alphaSenders[0] && service.alphaSenders[0].alphaSender || '');
                    modal.find(`select[name="phone_number"] option:contains(${service.phoneNumbers[0] && service.phoneNumbers[0].phoneNumber || ''})`).prop('selected', true);
                    modal.on('click', '.update-item', function (){
                        const {formData} = modal.formData();
                        formData.append('serviceSid', service.sid);
                        formData.append('alphaSenderSid', service.alphaSenders[0] && service.alphaSenders[0].sid || '')
                        formData.append('oldPhoneNumberSid', service.phoneNumbers[0] && service.phoneNumbers[0].sid || '')
                        let newPhoneNumber = modal.find(`select[name="phone_number"] option:selected`).text();
                        let $this = $(this);
                        $this.loading();
                        pAjax(obj.updateUrl, formData, res=>{
                            if(res.status){
                                $($(editBtn).parents('tr').find('td')[2]).text(res.data.service_name)
                                $($(editBtn).parents('tr').find('td')[5]).text(res.data.service_alias)
                                $($(editBtn).parents('tr').find('td')[4]).text(newPhoneNumber)
                                itoastr('success', res.message)
                                modal.modal('hide')
                            }
                            $this.loading(false);
                        })
                    })
                }
            });
        })
    </script>
@endsection
