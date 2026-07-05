<aside class="sidebar">

    <div class="logo">
        <h3>Semáforo</h3>
        <small>Contable</small>
    </div>

    {{-- ================= ADMINISTRADOR ================= --}}
    @if(auth()->user()->isAdmin())

        <x-sidebar-section title="General">

            <x-sidebar-item
                :route="route('dashboard')"
                icon="bi-grid-fill"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('companies.index')"
                icon="bi-buildings"
                :active="request()->routeIs('companies.*')">
                Empresas
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('periods.index')"
                icon="bi-calendar3"
                :active="request()->routeIs('periods.*')">
                Períodos
            </x-sidebar-item>

        </x-sidebar-section>

        <x-sidebar-section title="Operación">

            <x-sidebar-item
                :route="route('expedients.index')"
                icon="bi-folder2-open"
                :active="request()->routeIs('expedients.*')">
                Expedientes
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('reports.index')"
                icon="bi-bar-chart"
                :active="request()->routeIs('reports.*')">
                Reportes
            </x-sidebar-item>

        </x-sidebar-section>

        <x-sidebar-section title="Administración">

            <x-sidebar-item
                :route="route('configuration.index')"
                icon="bi-gear"
                :active="request()->routeIs('configuration.*')">
                Configuración
            </x-sidebar-item>

        </x-sidebar-section>

    @endif


    {{-- ================= ASISTENTE ================= --}}
    @if(auth()->user()->isAssistant())

        <x-sidebar-section title="General">

            <x-sidebar-item
                :route="route('dashboard')"
                icon="bi-grid-fill"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-sidebar-item>

        </x-sidebar-section>

        <x-sidebar-section title="Operación">

            <x-sidebar-item
                :route="route('expedients.index')"
                icon="bi-folder2-open"
                :active="request()->routeIs('expedients.*')">
                Expedientes
            </x-sidebar-item>

        </x-sidebar-section>

    @endif


    {{-- ================= CONTADOR ================= --}}
    @if(auth()->user()->isAccountant())

        <x-sidebar-section title="General">

            <x-sidebar-item
                :route="route('dashboard')"
                icon="bi-grid-fill"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('companies.index')"
                icon="bi-buildings"
                :active="request()->routeIs('companies.*')">
                Empresas
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('periods.index')"
                icon="bi-calendar3"
                :active="request()->routeIs('periods.*')">
                Períodos
            </x-sidebar-item>

        </x-sidebar-section>

        <x-sidebar-section title="Operación">

            <x-sidebar-item
                :route="route('expedients.index')"
                icon="bi-folder2-open"
                :active="request()->routeIs('expedients.*')">
                Expedientes
            </x-sidebar-item>

            <x-sidebar-item
                :route="route('reports.index')"
                icon="bi-bar-chart"
                :active="request()->routeIs('reports.*')">
                Reportes
            </x-sidebar-item>

        </x-sidebar-section>

        <x-sidebar-section title="Administración">

            <x-sidebar-item
                :route="route('configuration.index')"
                icon="bi-gear"
                :active="request()->routeIs('configuration.*')">
                Configuración
            </x-sidebar-item>

        </x-sidebar-section>

    @endif

    <div class="sidebar-footer">

        <small>Semáforo Contable</small>

        <span>v1.0.0</span>

    </div>

</aside>