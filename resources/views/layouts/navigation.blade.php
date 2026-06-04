<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm border-bottom border-light">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2 text-danger" href="{{ route('dashboard') }}">
            <i class="bi bi-mortarboard-fill"></i>
            <span class="fw-bold">AsprakNotes</span>
        </a>

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button class="btn btn-link text-dark dropdown-toggle d-flex align-items-center gap-2" type="button"
                id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=b71c1c&color=fff"
                    alt="Profile" class="rounded-circle" width="32" height="32">
                <span class="d-none d-md-block">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
