<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <?php $currentRouteName = Route::current(); ?>
            <li class="{{ ($currentRouteName->getName() == 'admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home "></i> <span>Bảng chính</span></a>
            </li>

            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'user') ? 'active':'' }}">
                <a href="#">
                    <i class="fa fa-volume-control-phone"></i> <span>@lang('user.user')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-user"></i> <span>@lang('user.user')</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('user_group.index') }}">
                            <i class="fa fa-user"></i> <span>@lang('user.user_group')</span></a>
                    </li>

                </ul>
            </li>


            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'product') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-volume-control-phone"></i> <span>@lang('product.product')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($currentRouteName->getPrefix() == 'categories') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-user"></i> <span>@lang('category.category')</span></a>
                    </li>

                    <li class="{{ ($currentRouteName->getPrefix() == 'type') ? 'active' : '' }}">
                        <a href="{{ route('type.index') }}">
                            <i class="fa fa-user"></i> <span>@lang('type.type')</span></a>
                    </li>

                    <li class="{{ ($currentRouteName->getPrefix() == 'product') ? 'active' : '' }}">
                        <a href="{{ route('product.index') }}">
                            <i class="fa fa-user"></i> <span>Nhà/ Đất</span></a>
                    </li>

                    <li class="{{ ($currentRouteName->getPrefix() == 'investor') ? 'active' : '' }}">
                        <a href="{{ route('investor.index') }}">
                            <i class="fa fa-user"></i> <span> @lang('investor.investor')</span></a>
                    </li>
                </ul>
            </li>





            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'blog')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-volume-control-phone"></i> <span>Blog</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('blog.index') }}">
                            <i class="fa fa-user"></i> Blog
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('blog-category.index') }}">
                            <i class="fa fa-user"></i> @lang('blog.category')
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ strrpos($currentRouteName->getPrefix(), 'systems')?'active':'' }} treeview" >
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Danh mục</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ ($currentRouteName->getName() == 'continent.index') ? 'active' : '' }}">
                        <a href="{{ route('continent.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('admin.continent') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'country.index') ? 'active' : '' }}">
                        <a href="{{ route('country.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('admin.country') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'city.index') ? 'active' : '' }}">
                        <a href="{{ route('city.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('admin.city') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'district.index') ? 'active' : '' }}">
                        <a href="{{ route('district.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('admin.district') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'ward.index') ? 'active' : '' }}">
                        <a href="{{ route('ward.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('admin.ward') }}
                        </a>
                    </li>
                </ul>
            </li>



            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'admin_user')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-volume-control-phone"></i> <span>Hệ thống</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="">
                            <i class="fa fa-user"></i> Người dùng
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('back.configuration') }}"><i class="fa fa-volume-control-phone"></i> Cấu hình</a>
            </li>
                <hr>
            <li>
                <a href="{{ route('generate.sitemap') }}">Generate Sitemap</a>
            </li>

            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>