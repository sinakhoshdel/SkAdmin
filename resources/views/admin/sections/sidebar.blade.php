<!-- Left Sidebar -->
<div class="left main-sidebar">
    <div class="sidebar-inner leftscroll">
        <div id="sidebar-menu">
            <ul>
                <li class="submenu">
                    <a class="{{Request::path()=='admin' ? 'active' : ''}}" href="{{url('admin')}}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                </li>
                @can('category_manager')
                <li class="submenu">
                    <a href="{{url('admin/category')}}" class="{{Request::path()=='admin/category' ? 'active' : Request::path()=='admin/category/create' ? 'active' : ''}}" href="#"><i class="fa fa-folder-open-o bigfonts"></i> <span>  Category Manager </span></a>
                </li>
                @endcan
                @can('file_manager')
                <li class="submenu">
                    <a class="{{Request::path()=='admin/fileManager' ? 'active' : ''}}" href="{{url('admin/fileManager')}}"><i class="fa fa-fw fa-archive"></i><span> File Manager </span> </a>
                </li>
                @endcan
                @can('gallery_manager')
                <li class="submenu">
                    <a  href="{{url('admin/gallery')}}" class="{{Request::path()=='admin/gallery' ? 'active' : Request::path()=='admin/gallery/create' ? 'active' : ''}}" href="#"><i class="fa fa-file-image-o bigfonts"></i> <span>  Gallery Manager </span></a>
                </li>
                @endcan
                @can('menu_manager')
                <li class="submenu">
                    <a href="{{url('admin/menu')}}" class="{{Request::path()=='admin/menu' ? 'active' : Request::path()=='admin/menu/create' ? 'active' : ''}}" href="#"><i class="fa fa-bars bigfonts"></i> <span>  Menu Manager </span></a>
                </li>
                @endcan
                @can('content_manager')
                <li class="submenu">
                    <a href="{{url('admin/content')}}" class="{{Request::path()=='admin/content' ? 'active' : Request::path()=='admin/content/create' ? 'active' : ''}}" href="#"><i class="fa fa-file-text-o bigfonts"></i> <span>  Content Manager </span></a>
                </li>
                @endcan
                @can('message_manager')
                <li class="submenu">
                    <a href="{{url('admin/message')}}" class="{{Request::path()=='admin/message' ? 'active' : ''}}" href="#">
                        <i class="fa fa-envelope-o bigfonts"></i>
                        <span>  Message Manager</span>
                        @if($commonData['unreadMessages']!==0) <span class="badge badge-danger">{{$commonData['unreadMessages']}}</span>@endif
                    </a>
                </li>
                @endcan
                @can('settings_manager')
                <li class="submenu">
                    <a class="{{Request::path()=='admin/settings' ? 'active' : ''}}" href="{{url('admin/settings')}}"><i class="fa fa-fw fa-cog"></i><span> Settings </span> </a>
                </li>
                @endcan
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End Sidebar -->
