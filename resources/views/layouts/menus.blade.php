<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <a href="index.html" class="brand-logo">
        {{-- <img class="logo-abbr" src="{{asset('assets/images/ltt_logo.png')}}" alt=""> --}}
        {{-- <img class="logo-compact" src="{{asset('assets/images/ltt_logo.png')}}" alt=""> --}}
        <img class="brand-title white-image" src="{{asset('assets/images/ltt_logo.png')}}" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript::void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                                <i class="icon-logout"></i>
                                <span class="ml-2">Logout </span>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="nav-label first">Main Menu</li> --}}
            <li><a href="{{route('home')}}"><i class="icon icon-world-2"></i><span class="nav-text">Dashboard</span></a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                class="icon icon-app-store"></i><span class="nav-text">Companies</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('companies.index')}}">List</a></li>
                    <li><a href="{{route('companies.create')}}">Create</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->