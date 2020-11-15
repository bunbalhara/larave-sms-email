<div>
    <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
        <i class="la la-close"></i>
    </button>
    <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">

        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light position-static" m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
            <ul class="m-menu__nav ">
                <li class="m-menu__item {{ Request::is('admin/dashboard*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.dashboard')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/dashboard.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">Dashboard</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/new-message*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.new-message')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/sms.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">New SMS</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/new-email*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.new-email')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/new-email.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">New Email</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/recipient*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.recipient.index')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/recipients.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">Recipients</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/user*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.user.index')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/user.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">Users</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/message*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.message.index')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/messages.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">SMS Messages</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/email*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.email.index')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/messages.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">Emails</span>
                    </a>
                </li>
                <li class="m-menu__item {{ Request::is('admin/setting*') ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.setting.index')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon">
                            <img src="{{asset('assets/img/settings.svg')}}" alt="dashboard">
                        </i>
                        <span class="m-menu__link-text">Setting</span>
                    </a>
                </li>
                <li class="m-menu__item" aria-haspopup="true">
                    <a href="javascript:void(0);" class="m-menu__link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="m-menu__link-icon fa fa-sign-out-alt"></i>
                        <span class="m-menu__link-text">Log out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- END: Aside Menu -->
    </div>
</div>
<!-- END: Left Aside -->
