<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>
        @auth
          @role('TeamLeader')
          <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Usuarios</a></li>
          <li><a href="{{ route('roles.index') }}" class="nav-link px-2 text-white">Roles</a></li>
          <li><a href="{{ route('horarios.index') }}" class="nav-link px-2 text-white">Horarios</a></li>
          <li><a href="{{ route('proveedors.index') }}" class="nav-link px-2 text-white">Proveedores</a></li>
          <li><a href="{{ route('empresaClientes.index') }}" class="nav-link px-2 text-white">Clientes</a></li>
          <li><a href="{{ route('tipoRcps.index') }}" class="nav-link px-2 text-white">Tipo RCP</a></li>
          <li><a href="{{ route('sedes.index') }}" class="nav-link px-2 text-white">Sedes</a></li>
          <li><a href="{{ route('reportes.index') }}" class="nav-link px-2 text-white">Reportería</a></li>
          <li><a href="{{ route('apis.index') }}" class="nav-link px-2 text-white">ApiShowcase</a></li>
          @endrole
          <li><a href="{{ route('rcps.index') }}" class="nav-link px-2 text-white">RCPs</a></li>
          <li><a href="{{ route('llamadas.index') }}" class="nav-link px-2 text-white">Llamadas</a></li>
          @endauth
      </ul>

      @auth
        {{auth()->user()->name}}&nbsp;
        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
        </div>
      @endguest
    </div>
  </div>
</header>