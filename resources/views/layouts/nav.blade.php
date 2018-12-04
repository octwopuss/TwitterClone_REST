<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1c3456;">
  <a class="navbar-brand" href="{{route('dashboard')}}"> <span>Bagi Momen <i class="fa fa-heart"></i></span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <form class="form-inline my-2 my-lg-0" name="searchUser" action="{{route('searchFriend')}}">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" id="userSearch">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </li>                       
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-gear"></span></a>
                <div class="dropdown-menu" style="margin-left: -120px;">
                    <a class="dropdown-item" href="{{route('dashboard')}}"><i class="fa fa-home"></i> Beranda</a>             
                    <a class="dropdown-item" href="{{ route('showFriend', Auth::guard('users')->user()->username) }}"><i class="fa fa-user"></i> Profil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>                    
                </div>
            </li>
        </ul>
  </div>
</nav>