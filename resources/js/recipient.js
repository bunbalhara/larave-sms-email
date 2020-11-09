window.intlTelInput = require('intl-tel-input');

$(document).ready(function (){

    intlTelInput($('.phone-number')[0], {
        initialCountry:'lv',
        separateDialCode: true
    });

    $('.crud-table').crud({
        urls:{
            delete:'/admin/recipient/delete',
        },
        csvImport: true,
        multiSubmitForAdd: true,
        addFormSubmit: function (table, form){
            let formData = new FormData();
            $(form).find('.create-item').loading()
            $(form).find('.form-item').each(function (){
                let name = $(this).find('input[name="name[]"]').val();
                let countryCode = $(this).find('.iti__selected-dial-code').text();
                let phoneNumber = $(this).find('input[name="phone_number[]"]').val().replace(/ /g,'');
                formData.append('name[]', name);
                formData.append('phone_number[]', countryCode + phoneNumber)
                $(form).find('.create-item').loading(false)
            })
            pAjax('/admin/recipient/add', formData, function (res){
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

    $(document).on('click', '.btn-add-more', function (e){
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

