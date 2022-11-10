<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @hasrole('Admin')
      @include('partials.menusdasboard.admin')
    @endhasrole

    @hasanyrole('Juridico|Psicologo')
      @include('partials.menusdasboard.profesional')
    @endhasrole

    @hasrole('Usuario')
      @include('partials.menusdasboard.user')
    @endhasrole
    <li class="nav-item nav-category">Cuenta</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('usuario.perfil') }}">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">Perfil</span>
        </a>
    </li>
  </ul>
</nav>