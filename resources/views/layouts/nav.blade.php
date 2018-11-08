<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1c3456;">
  <a class="navbar-brand" href="{{route('dashboard')}}"> <span>Bagi Momen <i class="fa fa-heart"></i></span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <form class="form-inline my-2 my-lg-0" name="searchUser">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search" id="userSearch">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('showFriend', Auth::guard('users')->user()->username) }}" style="color: white;"> <span class="fa fa-user"></span>  {{ Auth::guard('users')->user()->name }} </a>
            </li>
            <li class="nav-item">
                </span><a class="nav-link" href="{{ route('logout') }}" style="color: white;"><span class="fa fa-power-off"></span> Logout</a>
            </li>
        </ul>
  </div>
</nav>