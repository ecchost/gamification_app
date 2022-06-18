<nav class="navbar navbar-secondary fixed-top navbar-expand-lg navbar-light" style="background: #ffffff; left:0">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <button id="run-btn" onclick="runCode()" class="btn-primary btn"><i class="fa fa-play"></i> Run </button>
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
                                <a class="nav-link" href="">Total Score: <b>{{ \App\Models\UserScore::getScore() }}</b></a>
                            </li>
                            <li><hr class="dropdown-divider" /> </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                                <li class="nav-item">
                                    <a href="{{ route("admin.dashboard") }}" class="nav-link">Goto Admin</a>
                                </li>
                            @endif
                            <br />
                            <li class="nav-item">
                                <div class="nav-link">
                                    {!! Form::open(["route"=>"logout","method"=>"POST"]) !!}
                                    @csrf
                                    <button class="btn btn-danger btn-block">Logout <i class="fa fa-unlock"></i> </button>
                                    {!!Form::close() !!}
                                </div>

                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
