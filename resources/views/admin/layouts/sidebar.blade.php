<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('backend/img/avatar-6.jpg') }}" alt="..."
                class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{Request::is('admin/dashboard*') ? 'active' : ''}}"><a href="{{ route('admin.dashboard') }}"> <i class="icon-home"></i>Home </a></li>

        <li class="{{ (Request::is('category/view*') || Request::is('category/edit*')) ? 'active' : ''}}"><a href="{{ route('category.view') }}"> <i class="fa fa-list-alt"></i>Category </a></li>

        <li class="{{ (Request::is('product/view*') || Request::is('product/add*') || Request::is('product/edit*')) ? 'active' : ''}}"><a href="{{ route('admin.product.view') }}"> <i class="fa fa-list-alt"></i>Product </a></li>

        {{-- <li class="{{ (Request::is('product/view*') || Request::is('product/add*') || Request::is('product/edit*')) ? 'active' : ''}}"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Product </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled">
                <li class="{{Request::is('product/view*') ? 'active' : ''}}"><a href="{{ route('product.view') }}">View</a></li>
                <li class="{{Request::is('product/add*') ? 'active' : ''}}"><a href="{{ route('product.add') }}">Add</a></li>
                <li class="{{Request::is('product/edit*') ? 'active' : ''}}"><a href="{{ route('product.edit', ['id' => 1]) }}">Edit</a></li>
            </ul>
        </li> --}}

        <li class=""><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>

        <li class=""><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>

        <li class="{{Request::is('admin/login*') ? 'active' : ''}}"><a href=""> <i class="icon-logout"></i>Login page </a></li>
    </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
        <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
        <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul>
</nav>
