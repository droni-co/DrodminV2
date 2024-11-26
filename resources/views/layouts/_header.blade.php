<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('img/logo-w.png') }}" alt="Logo" width="20" height="20">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarHeader" aria-controls="navBarHeader" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navBarHeader">
      @if($site)
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="{{ route('sites.show', $site) }}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            {{ $site->name }}
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="mdi mdi-pencil-box-multiple-outline"></i>
            Contenido
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('sites.categories.index', $site)}}">Categorías</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.posts.index', $site)}}">Posts</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.attachments.index', $site)}}">Multimedia</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="mdi mdi-forum-outline"></i>
            Comunidad
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('sites.comments.index', $site)}}">Foros</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.comments.index', $site)}}">Comentarios</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.enrollments.index', $site)}}">Usuarios</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search" action="{{ route('sites.search', $site) }}" method="GET">
        <input
          class="form-control me-2 rounded-pill"
          type="search"
          placeholder="Search"
          name="q"
          aria-label="Search"
          value="{{ request('q') }}">
      </form>
      @else
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      @endif
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-link text-white" type="submit">
              <i class="mdi mdi-logout"></i>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
