<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-gradient-white"
     id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand">
                <img src="{{ asset('img/brand/logo-brand.png') }}" class="img-fluid" style="min-height: 35px;">
                <h5 class="my-auto">Student Portal</h5>
            </a>
            <div class="ml-auto">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}" id="dashboard">
                            <i class="fas fa-home"></i>
                            <span class="nav-link-text">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    @if(count($app_data['courses']) > 0)
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#navbar-courses" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-dashboards">
                                <i class="fas fa-users"></i>
                                <span class="nav-link-text">Courses</span>
                            </a>
                            <div class="collapse" id="navbar-courses" style="">
                                <ul class="nav nav-sm flex-column">
                                    @foreach($app_data['courses'] as $course)
                                        <li class="nav-item">
                                            <a href="{{ route('courses.show', $course->id) }}" class="nav-link">
                                                <span class="sidenav-mini-icon"> C </span>
                                                <span class="sidenav-normal"> {{ $course->name }} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.join') }}" id="join-course">
                            <i class="fas fa-book"></i>
                            <span class="nav-link-text">
                                Enroll to Course
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-link-text">Logout</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
