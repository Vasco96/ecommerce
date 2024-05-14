<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li
                class="dropdown {{ setSidebarActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                    <li class="{{ setSidebarActive(['admin.subcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subcategory.index') }}">Sub Category</a></li>
                    <li class="{{ setSidebarActive(['admin.childcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.childcategory.index') }}">Child Category</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setSidebarActive([
                'admin.brand.*',
                'admin.products.*',
                'admin.products-image-gallery.*',
                'admin.products-variant.*',
                'admin.products-variant-item.*',
                'admin.vendor-products.index',
                'admin.vendor-pending-products.index'
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.brand.*']) }}"><a class="nav-link" href="{{ route('admin.brand.index') }}">Brands</a></li>
                    <li class="{{ setSidebarActive([
                        'admin.products.*',
                        'admin.products-image-gallery.*',
                        'admin.products-variant.*',
                        'admin.products-variant-item.*'
                        ]) }}"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="{{ setSidebarActive(['admin.vendor-products.index']) }}"><a class="nav-link" href="{{ route('admin.vendor-products.index') }}">Vendor Products</a></li>
                    <li class="{{ setSidebarActive(['admin.vendor-pending-products.index']) }}"><a class="nav-link" href="{{ route('admin.vendor-pending-products.index') }}">Vendor Pending Products</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setSidebarActive([
                'admin.vendor-profile.index',
                'admin.flash-sale.index'
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.flash-sale.index']) }}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    <li class="{{ setSidebarActive(['admin.vendor-profile.index']) }}"><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">Vendor Profile</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setSidebarActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                </ul>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}

        </ul>
    </aside>
</div>
