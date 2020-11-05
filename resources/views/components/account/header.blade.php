<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{{route('home')}}" class="m-brand__logo-wrapper">
                            Your Logo Here
                            {{-- <img alt="Logo" src="{{asset('assets/img/logo.png')}}" class="w-100 pt-1"/> --}}
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>

                <!-- END: Horizontal Menu -->
                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">

                </div>

                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown"
                                m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon">
                                        <span class="m-nav__link-icon-wrapper">
                                            <i class="flaticon-search-1"></i>
                                        </span>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner ">
                                        <div class="m-dropdown__header">
                                            <form class="m-list-search__form">
                                                <div class="m-list-search__form-wrapper">
														<span class="m-list-search__form-input-wrapper">
															<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
														</span>
                                                    <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
															<i class="la la-remove"></i>
														</span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                                <div class="m-dropdown__content">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1" >
                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                    <span class="m-nav__link-icon">
                                        <span class="m-nav__link-icon-wrapper">
                                            <i class="flaticon-alarm"></i>
                                        </span>
                                        <span class="m-nav__link-badge m-badge m-badge--danger">3</span>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper ">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner border-bottom-radius-20">
                                        <div class="m-dropdown__header m--align-center">
                                            <span class="m-dropdown__header-title">3 New</span>
                                            <a href="" class="m-dropdown__header-subtitle">View all notifications</a>
                                        </div>
                                        <div class="m-dropdown__body border-bottom-radius-20">
                                            <div class="m-dropdown__content">
                                                <div class="m-scrollable" data-scrollable="true" data-max-height="200" style="max-height:200px;">
                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                        <div class="m-list-timeline__items">
                                                            <div class="m-list-timeline__item">
                                                                <span class="m-list-timeline__badge"></span>
                                                                <a href="" class="m-list-timeline__text">This is test notification</a>
                                                                <span class="m-list-timeline__time">3 minutes ago</span>
                                                            </div>
                                                            <div class="m-list-timeline__item">
                                                                <a href="" class="m-list-timeline__text text-center">No new notification</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light pr-0" m-dropdown-toggle="click" style="margin-right:10px;">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <div class="m-topbar-dropdown_area">
                                        <span class="m-topbar__userpic">
                                            <img src="{{auth()->user()->avatar()}}"
                                                 class="m--img-rounded m--marginless m--img-centered" alt="avatar" />
                                        </span>
                                        <span class="m-topbar__name">
                                            {{user()->name}} <i class="fa fa-angle-down"></i>
                                        </span>
                                    </div>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner profile-dropdown">
                                        <div class="m-dropdown__header m--align-center">
                                            <div class="m-card-user m-card-user--skin-light">
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">{{user()->name}}</span>
                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">{{user()->email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav header_menu_dropdown">
                                                    <li class="m-nav__item">
                                                        <a href="/{{user()->hasRole('admin') ? 'admin': 'account'}}/profile">
                                                            Profile & Security
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                            Log Out
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                <span class="m-nav__link-icon">
                                    <i class="flaticon-grid-menu"></i>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
<!-- END: Header -->
