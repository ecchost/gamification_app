<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
  <a class="nav-link" href="/">
    <i class=" fas fa-building"></i><span>Dashboard</span>
  </a>
</li>
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
  <a href="{{ route('admin.roles.index') }}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('courses*') ? 'active' : '' }}">
  <a href="{{ route('admin.courses.index') }}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('lessons*') ? 'active' : '' }}">
  <a href="{{ route('admin.lessons.index') }}"><i class="fa fa-edit"></i><span>Lessons</span></a>
</li>
<li class="{{ Request::is('contents*') ? 'active' : '' }}">
  <a href="{{ route('admin.contents.index') }}"><i class="fa fa-edit"></i><span>Contents</span></a>
</li>
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
  <a href="{{ route('admin.questions.index') }}"><i class="fa fa-edit"></i><span>Questions</span></a>
</li>
