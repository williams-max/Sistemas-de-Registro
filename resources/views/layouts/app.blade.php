<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="dist/js/adminlte.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                   
                    <!-- Usuario Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-alt"></i>
                          
                            <?php  
                            $cargo = DB::table('personal_academicos')
                                        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
                                        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
                                        ->join('role_user', 'role_user.user_id', '=', 'users.id')
                                        ->join('roles', 'roles.id', '=', 'role_user.role_id')
                                        ->select('personal_academicos.*')
                                        ->where('users.id','=',Auth::user()->id)->first();

                            ?>
                            <span >{{$cargo->nombre ?? Auth::user()->name}} {{ $cargo->apellido ?? " "}}</span>
                          
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="info">
                                <a href="#" class="d-block">
                                    @guest
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                    @else
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
    
                                    @endguest
                                </a>
                            </div>
                        </div>

                    </li>

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell"></i>
                          
                                @if (count(auth()->user()->unreadNotifications))
                                    <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications)}}</span>
                                @endif
                          
                        </a>

                        
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Notificaciones no Leidas</span>
                            @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> {{$notification->data['description']}}
                                <span class="ml-3 pull-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
                            </a>
                            @empty
                            <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones por leer</span>
                            @endforelse
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-header">Notificaciones Leidas</span>
                            @forelse (auth()->user()->readNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> {{$notification->data['description']}}
                                <span class="ml-3 pull-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
                            </a>
                            
                            @empty
                             <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones leeidas</span>
                            @endforelse
                        
                      
                            <div class="dropdown-divider"></div>
                            <a href="{{route('markAsRead')}}" class="dropdown-item dropdown-footer">Marcar todas como Leidas</a>
                        </div>
                    </li>
                </ul>

              

              
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">-->
                    <span class="brand-text font-weight-light">
                        <br/>Sistema de Registro y <br/> Avance de Materia

                    </span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    @cannot('Administrador')
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                       <!-- <div class="image">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>-->
                        <a >
                            <?php  
                                $cargo = DB::table('personal_academicos')
                                            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
                                            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
                                            ->join('role_user', 'role_user.user_id', '=', 'users.id')
                                            ->join('roles', 'roles.id', '=', 'role_user.role_id')
                                            ->select('roles.*')
                                            ->where('users.id','=',Auth::user()->id)->first();

                    ?>
                    <span style="color:rgb(255, 255, 255)">{{$cargo->name}}</span>
                        </a>
                    </div>
                    @endcannot
                    

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                                <a href="/" class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Inicio</p>
                                </a>
                            </li>
                            @Can('Administrador')
                             <li class="nav-item">
                                <a href="{{url('/personalAcademico')}}"
                                    class="{{ Request::path() === 'personalAcademico' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                       Registrar Personal Academico
                                       
                                    </p>
                                </a>
                            </li>
                            
                           
                            <li class="nav-item">
                                <a href="{{url('roles')}}"
                                    class="{{ Request::path() === 'roles' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Cargos
                                      </p>
                                </a>
                            </li>
                            @endCan
                      
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">

                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
           

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>
</body>

</html>