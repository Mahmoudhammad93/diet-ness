<!-- Page Body Start-->
<div class="page-body-wrapper">
    <!-- Page Sidebar Start-->
    <div class="sidebar-wrapper">
        <div>
            <div class="logo-wrapper">
                <a href="{{ aurl('/') }}">
                    <h3>{{ settings()->name }}</h3>
                    {{-- <img class="img-fluid" style="max-width: 45%" src="{{ asset('dashboard') }}/assets/images/logo.png" alt=""> --}}
                    {{-- <img class="img-fluid for-dark" src="{{ asset('dashboard') }}/assets/images/logo/logo_dark.png" alt=""> --}}
                    {{-- <h3>{{ trans('admin.app_name') }}</h3> --}}
                </a>
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper">
                <a href="{{ aurl('/') }}">
                    {{-- <img class="img-fluid"src="{{ asset('dashboard') }}/assets/images/logo/logo-icon.png" alt=""> --}}
                    <h3>{{ settings()->name }}</h3>
                </a>
            </div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href="{{ aurl('/') }}"><img class="img-fluid"
                                    src="{{ asset('dashboard') }}/assets/images/favicon.png" alt=""></a>
                            <div class="mobile-back text-end"><span>{{ trans('admin.Back') }}</span><i
                                    class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ aurl('/') }}">
                                <i data-feather="home"> </i><span>{{ trans('admin.Dashboard') }}</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ aurl('exceptions') }}">
                                <i data-feather="alert-triangle"> </i><span>Exceptions</span>
                            </a>
                        </li>

                        <li class="sidebar-main-title">
                            <div>
                                <p>{{ trans('admin.Reports') }}</p>
                            </div>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="pie-chart"></i><span>{{ trans('admin.Sales') }} <i
                                        class="fa fa-angle-right pull-right" style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('sales') }}">{{ trans('admin.All Sales') }}</a></li>
                                <li><a href="{{ aurl('sales/daily') }}">{{ trans('admin.Daily Sales') }}</a></li>
                                <li><a href="{{ aurl('sales/weekly') }}">{{ trans('admin.Weekly Sales') }}</a></li>
                                <li><a href="{{ aurl('sales/monthly') }}">{{ trans('admin.Monthly Sales') }}</a></li>
                                <li><a href="{{ aurl('sales/yearly') }}">{{ trans('admin.Yearly Sales') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-main-title">
                            <div>
                                <p>{{ trans('admin.Content') }}</p>
                            </div>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="calendar"></i>
                                <span>{{ trans('admin.Subscriptions') }} <i class="fa fa-angle-right pull-right"
                                        style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('subscriptions') }}">{{ trans('admin.All Subscriptions') }}</a></li>
                                <li><a href="{{ aurl('subscriptions/started') }}">{{ trans('admin.All Started Subscriptions') }}</a></li>
                                <li><a href="{{ aurl('subscriptions/ended') }}">{{ trans('admin.All Ended Subscriptions') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="archive"></i>
                                <span>{{ trans('admin.Packages') }} <i class="fa fa-angle-right pull-right"
                                        style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('packages') }}">{{ trans('admin.All Packages') }}</a></li>
                                <li><a href="{{ aurl('packages/create') }}">{{ trans('admin.Add New Package') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="archive"></i>
                                <span>{{ trans('admin.Calories') }} <i class="fa fa-angle-right pull-right"
                                        style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('calories') }}">{{ trans('admin.All Calories') }}</a></li>
                                {{-- <li><a href="{{ aurl('packages/create') }}">{{ trans('admin.Add New Package') }}</a></li> --}}
                            </ul>
                        </li>

                        <li class="sidebar-main-title">
                            <div>
                                <p>{{ trans('admin.Navigation') }}</p>
                            </div>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="unlock"></i>
                                <span>{{ trans('admin.Roles') }} <i class="fa fa-angle-right pull-right"
                                        style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('roles') }}">{{ trans('admin.All Roles') }}</a></li>
                                <li><a href="{{ aurl('roles/create') }}">{{ trans('admin.Add New Role') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="user"></i><span>{{ trans('admin.Admins') }} <i
                                        class="fa fa-angle-right pull-right" style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('admins') }}">{{ trans('admin.All Admins') }}</a></li>
                                <li><a href="{{ aurl('admins/create') }}">{{ trans('admin.Add New Admin') }}</a></li>
                                <li><a href="{{ aurl('admins/deleted') }}">{{ trans('admin.All Deleted Admins') }}</a>
                                </li>
                                <li><a href="{{ aurl('admins/logs') }}">{{ trans('admin.Admin Log') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="map-pin"></i><span>{{ trans('admin.Cities') }} <i
                                        class="fa fa-angle-right pull-right" style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('cities') }}">{{ trans('admin.All Cities') }}</a></li>
                                <li><a href="{{ aurl('cities/create') }}">{{ trans('admin.Add New City') }}</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="users"></i><span>{{ trans('admin.Users') }} <i
                                        class="fa fa-angle-right pull-right" style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('users') }}">{{ trans('admin.All Users') }}</a></li>
                            </ul>
                        </li>


                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title">
                                <i data-feather="settings"></i><span>{{ trans('admin.Settings') }} <i
                                        class="fa fa-angle-right pull-right" style="margin-top: 5px"></i></span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ aurl('settings') }}">{{ trans('admin.Settings') }}</a></li>
                                <li><a href="{{ aurl('settings/terms') }}">{{ trans('admin.Terms And Conditions') }}</a></li>
                                <li><a href="{{ aurl('settings/privacy') }}">{{ trans('admin.Privacy And Policy') }}</a></li>
                                <li><a href="{{ aurl('settings/about') }}">{{ trans('admin.About Us') }}</a></li>
                                <li><a href="{{ aurl('settings/contacts') }}">{{ trans('admin.Contact Us') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    </div>
    <!-- Page Sidebar Ends-->
    <div class="page-body">
        <br>
        <!-- Container-fluid starts-->
