<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
    <!-- BEGIN: Brand -->
    <div class="m-brand  m-brand--skin-light ">
        <a href="index.html" class="m-brand__logo">
            <img alt="logo.png" src="{{ asset('assets/media/img/logo/logo.png') }}"/>
        </a>
    </div>
    <!-- END: Brand -->
    <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " 
        data-menu-vertical="true"
         data-menu-scrollable="true" data-menu-dropdown-timeout="500"  
        >
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--submenu-fullheight" aria-haspopup="true"  data-menu-submenu-toggle="click" data-menu-dropdown-toggle-class="m-aside-menu-overlay--on">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-menu"></i>
                    <span class="m-menu__link-text">
                        Applications
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <div class="m-menu__wrapper">
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent m-menu__item--submenu-fullheight" aria-haspopup="true" >
                                <span class="m-menu__link">
                                    <span class="m-menu__link-text">
                                        Menus
                                    </span>
                                </span>
                            </li>
                            <li class="m-menu__section">
                                <h4 class="m-menu__section-text">
                                    Modules
                                </h4>
                                <i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="click" data-menu-submenu-mode="accordion">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Applications
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/applications/copyrights') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Copyrights
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/applications/industrial-designs') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Industrial Designs
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/applications/patents') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Patent
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/applications/utility-models') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Utilility Model
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/applications/trademarks') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Trademark
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="click" data-menu-submenu-mode="accordion">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Resources
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/resources/categories') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Categories
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                            <a  href="{{ url('/resources/status') }}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Statuses
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->
                            <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                <a  href="#" class="m-menu__link ">
                                    <span class="m-menu__link-text">
                                        Users
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__section">
                                <h4 class="m-menu__section-text">
                                    Reports
                                </h4>
                                <i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                <a  href="{{ url('/reports') }}" class="m-menu__link ">
                                    <span class="m-menu__link-text">
                                        Export Report
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="click" data-redirect="true">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-add"></i>
                    <span class="m-menu__link-text">
                        Add
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">
                                    Add
                                </span>
                            </span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a href="{{ url('applications/copyrights/add') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon la la-commenting"></i>
                                <span class="m-menu__link-text">
                                    Copyright Entry
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a href="{{ url('applications/industrial-designs/add') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon la la-commenting"></i>
                                <span class="m-menu__link-text">
                                    Industrial Deisgn Entry
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a href="{{ url('applications/patents/add') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon la la-commenting"></i>
                                <span class="m-menu__link-text">
                                    Patent Entry
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a href="{{ url('applications/utility-models/add') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon la la-commenting"></i>
                                <span class="m-menu__link-text">
                                    Utility Model Entry
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a href="{{ url('applications/trademarks/add') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon la la-commenting"></i>
                                <span class="m-menu__link-text">
                                    Trademark Entry
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--bottom" aria-haspopup="true"  data-menu-submenu-toggle="click" data-redirect="true">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-stopwatch"></i>
                    <span class="m-menu__link-text">
                        Customers
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent m-menu__item--bottom" aria-haspopup="true"  data-redirect="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">
                                    Applications
                                </span>
                            </span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Reports
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
                            <a  href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Cases
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-computer"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Completed
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--warning completed-bg badges m-badge--wide">
                                                            10
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-signs-2"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Finalized
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--danger finalized-bg badges m-badge--wide">
                                                            6
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Examined
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--success examined-bg badges m-badge--wide">
                                                            2
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-multimedia-2"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Published
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--info published-bg badges m-badge--wide">
                                                            4
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-multimedia-2"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Processed
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--info processed-bg badges m-badge--wide">
                                                            2
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-multimedia-2"></i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        New
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--info new-bg badges m-badge--wide">
                                                            7
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--bottom-2" aria-haspopup="true"  data-menu-submenu-toggle="click">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-settings"></i>
                    <span class="m-menu__link-text">
                        Settings
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--up">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent m-menu__item--bottom-2" aria-haspopup="true" >
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">
                                    Settings
                                </span>
                            </span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Accounts
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Notifications
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--bottom-1" aria-haspopup="true"  data-menu-submenu-toggle="click">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-info"></i>
                    <span class="m-menu__link-text">
                        Help
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--up">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent m-menu__item--bottom-1" aria-haspopup="true" >
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">
                                    Help
                                </span>
                            </span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Support
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Documentation
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Terms
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<div class="m-aside-menu-overlay"></div>