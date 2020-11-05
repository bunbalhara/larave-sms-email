$(document).ready(function() {
    var $container = $("#m_ver_menu");
    var $scrollTo  = $("#m_ver_menu .m-menu__item--active").not(".m-menu__item--open");
    if($scrollTo.length)
    {
        var height = $scrollTo.offset().top-$container.height()/2;

        if(height>0)
        {
            $('#m_ver_menu').stop().animate({
                scrollTop: height
            }, 300);
        }
    }
});

$(".m-menu__item .m-menu__link:not(.m-menu__toggle)").click(function() {
    $(".m-menu__item").removeClass("m-menu__item--active");
    $(this).parent().addClass("m-menu__item--active")
});

