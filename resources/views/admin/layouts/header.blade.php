<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-right">
                    <div class="dropdown dib">
                        <div class="header-icon" data-toggle="dropdown">
                            <i class="ti-bell"></i>
                        </div>
                    </div>
                    <div class="dropdown dib">
                        <div class="header-icon" data-toggle="dropdown">
                            <i class="ti-email"></i>

                        </div>
                    </div>
                    @if (Auth::check())
                    <div class="dropdown header-icon">
                        <i class="user-avatar" data-toggle="dropdown">{{Auth::user()->name}}
                            <i class="ti-angle-down f-s-10"></i>
                        </i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('profile')}}">
                                <i class="ti-user"></i>
                                <span>Thông tin cá nhân</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="ti-email"></i>
                                <span>Tin nhắn</span>
                            </a>
                            @can('is-admin')
                            <a class="dropdown-item" href="{{route('settings')}}">
                                <i class="ti-settings"></i>
                                <span>Cài đặt</span>
                            </a>
                            @endcan
                            <a class="dropdown-item" href="/logout">
                                <i class="ti-power-off"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
