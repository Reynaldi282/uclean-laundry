<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container -->
    <div class="container">
        <!-- begin navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{url('/')}}" class="navbar-brand">
                @if (isset($setpage) && $setpage->img_hero != null)
                <span><img src="{{URL::asset($setpage->img_hero)}}" height="40" width="40" style="float:left; margin-right:10px"></span>
                @else
                <span class="navbar-logo"></span>
                @endif
                <span class="brand-text">
                    {{$setpage != NULL ? $setpage->judul : 'OmahKu Laundry'}}
                </span>
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- begin #header-navbar -->
        <div class="collapse navbar-collapse" id="header-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#background">Background</a></li>
                <li><a href="#vision">Vision</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#methods">Methods</a></li>
                <li><a href="#clients">Clients</a></li>
                <li><a href="#equipments">Equipments</a></li>
                <li><a href="#contact">Contact</a></li>
                @auth
                <li> <a href="{{url('/home')}}">Welcome, {{ Auth::user()->name }}</a> </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else
                <li><a href="{{route('login')}}">Masuk</a></li>
                @endauth
            </ul>
        </div>
        <!-- end #header-navbar -->
    </div>
    <!-- end container -->
</div>