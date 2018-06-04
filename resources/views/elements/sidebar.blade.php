<nav class="sidebar-nav">
    <ul class="nav">

        <li class="nav-title">Navegação</li>

        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link">
                <i class="icon icon-speedometer"></i> Painel
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard.calls') }}" class="nav-link">
                <i class="icon-earphones-alt"></i> Atendimento
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard.leads') }}" class="nav-link">
                <i class="icon-book-open"></i> Leads
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard.settings') }}" class="nav-link">
                <i class="icon-settings"></i> Configurações
            </a>
        </li>

    </ul>
</nav>
