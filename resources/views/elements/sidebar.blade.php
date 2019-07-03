<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">Navegação</li>

        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="icon icon-speedometer"></i> Painel
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">
                <i class="icon icon-note"></i> Ordens
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dividends.index') }}" class="nav-link">
                <i class="icon icon-wallet"></i> Dividendos
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('deposits.index') }}" class="nav-link">
                <i class="icon icon-calculator"></i> Depósitos
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="icon icon-graph"></i> Patrimônio
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="icon icon-target"></i> Radar
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('brokers.index') }}" class="nav-link">
                <i class="icon icon-grid"></i> Corretoras
            </a>
        </li>

    </ul>
</nav>
