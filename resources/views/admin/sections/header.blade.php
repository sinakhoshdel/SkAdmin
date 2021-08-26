<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | @yield('title','Awesome')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{url('images/favicon.ico')}}">
    <!-- Custom CSS -->
    <link href="{{url('css/admin.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome CSS -->
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- BEGIN CSS for this page -->
    @yield('styles')
    <!-- END CSS for this page -->
</head>
<body class="adminbody">
    <div id="main">
    <!-- top bar navigation -->
    <div class="headerbar">
        <!-- LOGO -->
        <div class="headerbar-left">
            <a href="{{url('admin')}}" class="logo"><img alt="logo" src="{{url('files/shares/logo/logo.png')}}"><span> Admin</span></a>
        </div>
        <nav class="navbar-custom">
            <ul class="list-inline float-right mb-0">
                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-question-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small>Help and Support</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a target="_blank" href="" class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want custom development to integrate this theme?</b>
                                <span>Contact Us</span>
                            </p>
                        </a>

                        <!-- item-->
                        <a target="_blank" href=""
                           class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                <span>Try it now</span>
                            </p>
                        </a>

                        <!-- All-->
                        <a title="Clcik to visit Pike Admin Website" target="_blank" href=""
                           class="dropdown-item notify-item notify-all">
                            <i class="fa fa-link"></i> Visit sinakhoshdel.me
                        </a>

                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope-o"></i>
                        @if($commonData['unreadMessages']!==0)
                            <span class="notif-bullet"></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small>
                                    Contact Messages
                                    <span class="mt-1 badge badge-danger">{{$commonData['unreadMessages']}} Unread Massage</span>
                                </small>
                            </h5>
                        </div>
                    @if(count($commonData['lastMessages']))
                        @foreach($commonData['lastMessages'] as $k=>$message)
                            <!-- item-->
                                <a href="{{route('message.show',$message->id)}}" class="dropdown-item notify-item">
                                    <p class="notify-details ml-0">
                                        @if($message->unread ===1)
                                            <i class="mt-3 pull-right fa fa-circle text-primary"></i>
                                        @endif
                                        <b>{{$message->first_name}} {{$message->last_name}}</b>
                                        <span>{{$message->subject}}</span>
                                        <small class="text-muted">{{$message->created_at}}</small>
                                    </p>
                                </a>
                            @endforeach
                        @else
                            <p class="p-5 text-center notify-details ml-0">
                                Inbox is empty!
                            </p>
                        @endif
                    <!-- All-->
                        @if(count($commonData['lastMessages']))
                            <a href="{{url('admin/message')}}" class="dropdown-item notify-item notify-all">
                                View All
                            </a>
                        @endif
                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small><span class="label label-danger pull-xs-right">5</span>Allerts</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a href="#" class="dropdown-item notify-item">
                            <div class="notify-icon bg-faded">
                                <img src="{{url('images/avatars/avatar2.png')}}" alt="img" class="rounded-circle img-fluid">
                            </div>
                            <p class="notify-details">
                                <b>John Doe</b>
                                <span>User registration</span>
                                <small class="text-muted">3 minutes ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="#" class="dropdown-item notify-item">
                            <div class="notify-icon bg-faded">
                                <img src="{{url('images/avatars/avatar3.png')}}" alt="img" class="rounded-circle img-fluid">
                            </div>
                            <p class="notify-details">
                                <b>Michael Cox</b>
                                <span>Task 2 completed</span>
                                <small class="text-muted">12 minutes ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="#" class="dropdown-item notify-item">
                            <div class="notify-icon bg-faded">
                                <img src="{{url('images/avatars/avatar4.png')}}" alt="img" class="rounded-circle img-fluid">
                            </div>
                            <p class="notify-details">
                                <b>Michelle Dolores</b>
                                <span>New job completed</span>
                                <small class="text-muted">35 minutes ago</small>
                            </p>
                        </a>

                        <!-- All-->
                        <a href="#" class="dropdown-item notify-item notify-all">
                            View All Allerts
                        </a>

                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        {{--<img src="{{url('images/avatars/admin.png')}}" alt="Profile image" class="avatar-rounded">--}}
                        <span class="fa fa-user tex"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow">
                                <small>HI {{ strtoupper(Auth::user()->name) }}</small>
                            </h5>
                        </div>

                        <!-- item-->
                    <a href="pro-profile.html" class="dropdown-item notify-item">
                        <i class="fa fa-user"></i> <span>Profile</span>
                    </a>

                    <!-- item-->
                        <a target="_blank" href="{{url('/')}}" class="dropdown-item notify-item">
                            <i class="fa fa-external-link"></i> <span> Preview</span>
                        </a>
                        <!-- item-->
                        <a href="/" class="dropdown-item notify-item" onclick="event.preventDefault(); $('#form-logout').submit();">
                            <i class="fa fa-power-off"></i> <span>Logout</span>
                        </a>
                        <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </li>
            </ul>

        </nav>

    </div>
    <!-- End Navigation -->
