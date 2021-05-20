<div class="card">
    <div class="card-header bg-dark  text-center">
        <h4 class="card-title">Menú</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills flex-column">
            @if(auth()->check())
                <li 
                    @if(request()->is('/') || request()->is('home')) class="active" @endif> <a href="{{ route('home') }}">Dashboard</a>
                </li>
                
                @if(auth()->user()->is_client)
                    <li 
                        @if(request()->is('crear-incidencia')) class="active" @endif> <a href="{{ route('report.create') }}">Reportar Incidencia</a>
                    </li>
                @endif

                @if(auth()->user()->is_support)
                    <li 
                        @if(request()->is('crear-incidencia')) class="active" @endif> <a href="{{ route('report.create') }}">Reportar Incidencia</a>
                    </li>
                @endif

                @if(auth()->user()->is_admin)
                    <li 
                        @if(request()->is('crear-incidencia')) class="active" @endif> <a href="{{ route('report.create') }}">Reportar Incidencia</a>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administración
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="{{ route('user.index') }}"> Usuarios </a></li>
                            <li class="dropdown-item"><a href="{{ route('clientes') }}"> Clientes </a></li>
                            <li class="dropdown-item"><a href="{{ route('project.index') }}">Proyectos</a></li>
                            <li class="dropdown-item"><a href="#">Configuración</a></li>
                        </ul>
                    </li>
               @endif
            @else
                <li> <a href="#">Bienvenido</a></li>
                <li> <a href="#">Instrucciones</a></li>
                <li> <a href="#">Créditos</a></li>
            @endif
        </ul>
    </div>
</div>
