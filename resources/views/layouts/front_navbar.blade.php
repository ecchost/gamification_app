<nav class="navbar navbar-secondary navbar-expand-lg navbar-light" style="background: #ffffff; left:0">
  <div class="container">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a href="/" class="nav-link has-dropdown"><i class="fas fa-fire nav-icon"></i> <span>Gamification</span></a>

      </li>
      <li class="nav-item">
        <a href="{{ route("home") }}" class="nav-link"><i class="fa fa-heart"></i> <span>Courses</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route("student_course.my_course") }}" class="nav-link "><i class="far fa-clone"></i> <span>My Course</span></a>
      </li>
    </ul>
      <div class="d-flex">
          <ul class="navbar-nav">
              @auth
              <li class="nav-item dropdown">
                  <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                      <i class="far fa-user-circle"></i>
                      <span>{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
                  </a>
                  <ul class="dropdown-menu">
                      <li class="nav-item">
                          <a class="nav-link" href="">Point: 0</a>
                      </li>
                      <li><hr class="dropdown-divider" /> </li>
                      <li class="nav-item">
                          <a class="nav-link" href="">Logout</a>
                      </li>
                  </ul>
              </li>
              @endauth
          </ul>
      </div>
  </div>
</nav>
