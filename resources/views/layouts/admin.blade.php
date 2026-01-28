<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración') - UTS</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo-uts.png') }}" alt="UTS" class="sidebar-logo">
                <h5>Panel Admin</h5>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.noticias') }}" class="nav-item {{ request()->routeIs('admin.noticias*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Noticias</span>
                </a>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-item btn-logout" style="border: none; background: none; width: 100%; text-align: left;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="main-content">
            <header class="top-bar">
                <button class="btn-menu" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="top-bar-right">
                    <div class="user-menu">
                        <div class="dropdown">
                            <button class="btn-user" type="button" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <span class="user-name">Administrador</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                            <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>