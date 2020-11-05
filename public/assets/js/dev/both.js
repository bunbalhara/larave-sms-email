$(document).on('click', ".tab-link", function() {
    var hash = this.hash;
    hashUpdate(hash);
});

function hashUpdate(hash) {
    if(hash!=='')
    {
        var a = hash.split("/");
        $(".tab-link").removeClass("tab-active");
        $(".tab_area").removeClass("area-active");
        $('.tab-link[data-area="'+a[0]+a[1]+'"]').addClass("tab-active");
        $(a[0]+a[1]+"_area").addClass("area-active");
        if(a[2]==null)
        {
            $(a[0]+a[1]+"_area").addClass("area-active");
        }else {
            $('.tab-link[data-area="'+a[0]+a[1]+a[2]+'"]').addClass("tab-active");
            $(a[0]+a[1]+a[2]+"_area").addClass("area-active");
        }
    }
}
$('.tooltip_1').tooltipster({
    theme: 'tooltipster-noir',
    trigger: 'click'
});
$('.tooltip_2').tooltipster({
    theme: 'tooltipster-noir',
    contentAsHTML:'true',
    trigger: 'click'
});
$('.tooltip_3').tooltipster({
    theme: 'tooltipster-noir',
});
function dispErrors($errors)
{
    for(var key in $errors)
    {
        var error = $errors[key];
        itoastr('error', error);
    }
}
function itoastr(title,message,type=null){
    if(type==null)
    {
        type=title.toLowerCase();
    }
    if(type == 'info') {
        iziToast.info({
            title: title,
            message: message,
            position: 'topCenter',
        });
    }else if(type == 'error'){
        iziToast.error({
            title: title,
            message: message,
            position: 'topCenter',
        });
    }
    else if(type == 'success'){
        iziToast.success({
            title: title,
            message: message,
            position: 'topCenter',
        });
    }
}
const askToast = {

    info:function(title, msg, action)
    {
        var obj = setObj(title, msg, action);
        iziToast.info(obj);
    },
    success:function(title, msg, action)
    {
        var obj = setObj(title, msg, action);
        iziToast.success(obj);
    },
    question:function(title, msg, action)
    {
        var obj = setObj(title, msg, action);
        iziToast.question(obj);
    },
    error:function(title, msg, action)
    {
        var obj = setObj(title, msg, action);
        iziToast.error(obj);
    },
}
function dispValidErrors(message)
{
    $.each(message, function(index, item) {
        $(".error-"+index).html(item);
    });
}
