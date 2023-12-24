<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/img/logo.png" alt="DalaHabo Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light" style="font-size: 32px;"><b>Hacimi</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <!--  nav-legacy text-sm nav-child-indent-->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent nav-legacy flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin" class="nav-link {{ (request()->is('admin')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>

                <!-- Mở thì thêm class menu-open -->
                <li class="nav-item  {{ (request()->is('admin/sliders/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Slider
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sliders/all" class="nav-link {{ (request()->is('admin/sliders/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sliders/create" class="nav-link {{ (request()->is('admin/sliders/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm slider</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">KHÁM PHÁ</li>
                <li class="nav-item {{ (request()->is('admin/categories/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>
                            Danh mục phim
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/movies/all" class="nav-link {{ (request()->is('admin/movies/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách phim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/movies/create" class="nav-link {{ (request()->is('admin/movies/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm phim</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('admin/customers/all')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Khách hàng
                            <i class="fas"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('admin/orders/all')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Yêu cầu
                            <i class="fas"></i>
                        </p>
                    </a>
                </li>


                @can('is-admin')
                <li class="nav-header">QUẢN LÝ NGƯỜI DÙNG</li>
                <li class="nav-item {{ (request()->is('admin/users/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Tài khoản
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/users/all" class="nav-link {{ (request()->is('admin/users/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách tài khoản</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users/create" class="nav-link {{ (request()->is('admin/users/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm tài khoản</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!-- /.sidebar-menu -->
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
