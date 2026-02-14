<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/layouts.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom px-3">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">
            SocialApp
        </a>

        <button class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between"
             id="navbarContent">

            <!-- ================== -->
            <!--        Search      -->
            <!-- ================== -->
            <form action="{{ route('friends.search') }}"
                  method="GET"
                  class="d-flex mx-auto"
                  style="max-width:400px; width:100%;">

                <input type="search"
                       name="q"
                       class="form-control"
                       placeholder="Search users..."
                       required>
            </form>

            <!-- ================== -->
            <!--   Navigation Right -->
            <!-- ================== -->
            <ul class="navbar-nav align-items-center">

                <!-- Friends -->
                <li class="nav-item me-3">
                    <a class="nav-link fw-semibold"
                       href="{{ route('friends.index') }}">
                        👥 Friends
                    </a>
                </li>

                <!-- Add Post -->
                <li class="nav-item me-3">
                    <a class="nav-link fw-semibold"
                       href="{{ route('posts.create') }}">
                        ➕ Add Post
                    </a>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link"
                       href="#"
                       data-bs-toggle="dropdown">
                        🔔 ({{ auth()->user()->unreadNotifications->count() }})
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li>
                                <a href="#"
                                   class="dropdown-item">
                                    {{ $notification->data['message'] }}
                                </a>
                            </li>
                        @empty
                            <li class="dropdown-item">
                                No notifications
                            </li>
                        @endforelse
                    </ul>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('ShowProfile') }}">
                                Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}"
                                  method="POST">
                                @csrf
                                <button type="submit"
                                        class="dropdown-item">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>


<div class="container mt-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>