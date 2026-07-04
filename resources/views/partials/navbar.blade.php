<nav class="navbar-custom">

    <div>

        <h4>

            @yield('title')

        </h4>

    </div>

    <div class="dropdown">

        <button
            class="btn btn-light dropdown-toggle"
            data-bs-toggle="dropdown"
        >

            {{ auth()->user()->name }}

        </button>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>

                <span class="dropdown-item-text">

                    {{ auth()->user()->email }}

                </span>

            </li>

            <li>

                <hr class="dropdown-divider">

            </li>

            <li>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        class="dropdown-item"
                        type="submit"
                    >

                        <i class="bi bi-box-arrow-right me-2"></i>

                        Cerrar sesión

                    </button>

                </form>

            </li>

        </ul>

    </div>

</nav>