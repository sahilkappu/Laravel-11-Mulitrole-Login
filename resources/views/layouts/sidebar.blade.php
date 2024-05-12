<div id="kt_aside" class="aside overflow-visible pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle" >
    <div class="aside-logo py-8" id="kt_aside_logo">
        <a href="{{ route('home') }}" class="d-flex align-items-center">
            <img alt="Logo" src="assets/media/images/web_allures.webp" class="h-30px w-90px logo" />
        </a>
    </div>
    <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
        <div class="hover-scroll-y my-2 my-lg-5 scroll-ms" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-700 fw-semibold" id="#kt_aside_menu" data-kt-menu="true">
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item   py-2">
                    <span class="menu-link dashboard menu-center pulse  hover-scale">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-home-2 fs-2x"></i>
                        </span>
                        <span class="menu-title">{{ __('DashBoard') }}</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown px-2 py-4 w-250px mh-75 overflow-auto">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('Home') }}</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link " href="/">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('DashBoard') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role_id ==1)
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
                        <span class="menu-link menu-center  hover-scale">
                            <span class="menu-icon me-0">
                                <i class="fa-solid fa-users"></i>
                                </i>
                            </span>
                            <span class="menu-title">{{ __('Users') }}</span>
                        </span>
                        <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                            <div class="menu-item">
                                <div class="menu-content">
                                    <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('Users') }}</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                    <a class="menu-link " href="{{route('users')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('User List') }}</span>
                                    </a>
                                </div>
                        </div>
                    </div>
                @elseif(Auth::user()->role_id == 2)
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
                        <span class="menu-link menu-center hover-scale">
                            <span class="menu-icon me-0">
                                <i class="fa-solid fa-user"></i>
                                </i>
                            </span>
                            <span class="menu-title">{{ __('Profile') }}</span>
                        </span>
                        <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                            <div class="menu-item">
                                <div class="menu-content">
                                    <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('Profile') }}</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                    <a class="menu-link " href="{{route("profile")}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('User Profile') }}</span>
                                    </a>
                                </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>