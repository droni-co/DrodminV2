<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
  <div class="container-fluid">
    <div class="dropdown px-4">
      <a class="nav-link dropdown-toggle py-2 text-white" href="#" data-bs-toggle="dropdown" aria-expanded="true">
        <i class="mdi mdi-menu"></i>
        {{ $site->name ?? 'Drodmin' }}
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href="{{ route('home') }}">
            <i class="mdi mdi-home"></i>
            Dashboard
          </a>
        </li>
        @foreach (Auth::user()->enrollments as $enrollment)
        <li>
          <a class="dropdown-item" href="{{ route('sites.posts.index', $enrollment->site)}}">
            <i class="mdi mdi-earth"></i>
            {{ $enrollment->site->name }}
          </a>
        </li>
        @endforeach
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarHeader" aria-controls="navBarHeader" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navBarHeader">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if($site)
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="true">
            Contenido
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('sites.categories.index', $site)}}">Categorías</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.posts.index', $site)}}">Posts</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.attachments.index', $site)}}">Multimedia</a></li>
            <li><a class="dropdown-item" href="{{ route('sites.comments.index', $site)}}">Comentarios</a></li>
          </ul>
        </li>
        @endif
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
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
