<nav class="navbar navbar-expand-lg  navbar-light" style="background-color: #31445f;">
            <a class="navbar-brand" href="{{route('dashboard')}}"> <span>Bagi Momen <i class="fa fa-heart"></i></span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>    
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('dashboard') }}" style="color: white;"> <span class="fa fa-user"></span>  {{ Auth::guard('users')->user()->name }} </a>
                  </li>
                  <li class="nav-item">
                      </span><a class="nav-link" href="{{ route('logout') }}" style="color: white;"><span class="fa fa-power-off"></span> Logout</a>
                  </li>
              </ul>
          </div>     
        </nav>            