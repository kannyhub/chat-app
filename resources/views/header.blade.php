<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('rooms') }}">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @can('is-admin')
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('user.all') }}">Users</a>
          </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
        </li>
      </ul>
      <li class="nav-item">
        <a class="text-light mx-3" style="text-decoration: none" href="#">
          {{ Auth::user()->name }}
          @can('is-admin')
            (Super Admin)
          @endcan
        </a>
      </li>
      @can('is-admin')
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      @endcan
    </div>
  </div>
</nav>