<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-gradient-white"
     id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand">
                <img src="{{ asset('img/brand/logo-brand.png') }}" class="img-fluid" style="min-height: 35px;">
                <h5 class="my-auto">Instructor Portal</h5>
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
                        <a class="nav-link" href="{{ route('instructor.dashboard') }}" id="dashboard">
                            <i class="fas fa-home"></i>
                            <span class="nav-link-text">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructor.courses') }}" id="courses">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span class="nav-link-text">
                                Course Management
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructor.students') }}" id="students">
                            <i class="fas fa-users"></i>
                            <span class="nav-link-text">
                                Student Management
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructor.exams') }}" id="exams">
                            <i class="fas fa-th-list"></i>
                            <span class="nav-link-text">
                                Exam Management
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
