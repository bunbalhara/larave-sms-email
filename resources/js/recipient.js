window.intlTelInput = require('intl-tel-input');

$(document).ready(function (){

    intlTelInput($('.phone-number')[0], {
        initialCountry:'lv',
        separateDialCode: true
    });

    let smsTable = $('.sms-crud-table').crud({
        deleteUrl:'/admin/recipient/delete',
        editUrl:'/admin/recipient/sms/edit',
        updateUrl:'/admin/recipient/sms/update',
        csvImport: true,
        multiSubmitForAdd: true,
        addFormSubmit: function (table, form){
            let formData = new FormData();
            $(form).find('.create-item').loading()
            $(form).find('.form-item').each(function (){
                let tag = $(this).find('input[name="tag[]"]').val();
                let name = $(this).find('input[name="name[]"]').val();
                let countryCode = $(this).find('.iti__selected-dial-code').text();
                let phoneNumber = $(this).find('input[name="phone_number[]"]').val().replace(/ /g,'');
                formData.append('tag[]', tag);
                formData.append('name[]', name);
                formData.append('phone_number[]', countryCode + phoneNumber)
                $(form).find('.create-item').loading(false)
            })
            pAjax('/admin/recipient/sms/add', formData, function (res){
                if(res.status){
                    for(let data of res.data){
                        table.fnAddData(data)
                        $(form).clear();
                    }
                    itoastr('success',res.data.length + " recipients saved Successfully")
                }
            })
        }
    });

    smsTable.container.on('click', '.btn-add-more', function (e){
        e.preventDefault();
        let formItem = $(this).parents('.form-item').clone();
        formItem.find('label').remove();
        $(this).parents('.form-item').clear();
        $(this).parents('.form-item').after(formItem);
        // intlTelInput(formItem.find('.phone-number')[0], {
        //     initialCountry:'lv',
        //     separateDialCode: true
        // });
        formItem.find('button').removeClass('.btn-add-more')
            .removeClass('btn-outline-success')
            .addClass('.remove-form-item')
            .addClass('btn-outline-danger')
            .html('<i class="fa fa-times"></i> Remove').click(function (){
            $(this).parents('.form-item').remove();
        })
    })

    let emailTable = $('.email-crud-table').crud({
        deleteUrl:'/admin/recipient/delete',
        editUrl:'/admin/recipient/email/edit',
        updateUrl:'/admin/recipient/email/update',
        csvImport: true,
        multiSubmitForAdd: true,
        addFormSubmit: function (table, form){
            let formData = new FormData();
            $(form).find('.create-item').loading()
            $(form).find('.form-item').each(function (){
                let tag = $(this).find('input[name="tag[]"]').val();
                let name = $(this).find('input[name="name[]"]').val();
                let countryCode = $(this).find('.iti__selected-dial-code').text();
                let phoneNumber = $(this).find('input[name="email[]"]').val().replace(/ /g,'');
                formData.append('tag[]', tag);
                formData.append('name[]', name);
                formData.append('email[]', countryCode + phoneNumber)
                $(form).find('.create-item').loading(false)
            })
            pAjax('/admin/recipient/email/add', formData, function (res){
                if(res.status){
                    for(let data of res.data){
                        table.fnAddData(data)
                        $(form).clear();
                    }
                    itoastr('success',res.data.length + " recipients saved Successfully")
                }
            })
        }
    });

    emailTable.container.on('click', '.btn-add-more', function (e){
        e.preventDefault();
        let formItem = $(this).parents('.form-item').clone();
        formItem.find('label').remove();
        $(this).parents('.form-item').clear();
        $(this).parents('.form-item').after(formItem);
        // intlTelInput(formItem.find('.phone-number')[0], {
        //     initialCountry:'lv',
        //     separateDialCode: true
        // });
        formItem.find('button').removeClass('.btn-add-more')
            .removeClass('btn-outline-success')
            .addClass('.remove-form-item')
            .addClass('btn-outline-danger')
            .html('<i class="fa fa-times"></i> Remove').click(function (){
            $(this).parents('.form-item').remove();
        })
    })
})

