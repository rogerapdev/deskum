<aside class="page-aside">
    <div class="be-scroller" data-simplebar="init">
        <div class="aside-content">
            <div class="content">
                <div class="aside-header">
                    <button data-target=".aside-nav" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="im im-arrow-down5"></span>
                    </button>
                    <span class="title">Atendimentos</span>
                    <p class="description text-muted small">Atendimento aos clientes</p>
                </div>
            </div>
            <div class="aside-nav collapse">

                <ul class="nav nav-tabs mt-2" role="tabaside">
                    <li class="nav-item">
                        <a class="nav-link {{ !in_url('reports') ? 'active' : '' }}" data-toggle="tab" href="#links" role="tab" aria-controls="links" aria-selected="true"><i class="icon-list"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ in_url('reports') ? 'active' : '' }}" data-toggle="tab" href="#reports" role="tab" aria-controls="reports"><i class="icon-docs"></i></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ !in_url('reports') ? 'active' : '' }}" id="links" role="tabpanel">

                        <ul class="navigation">
                            <li class="{{ active_url('calls') }}"><a href="{{ route('dashboard.calls') }}"><i class="icon-home"></i> Painel</a></li>
                            <li class="navigation-header">Geral</li>
                            <li class="{{ (in_url('tickets') and !in_url('reports')) ? 'active' : '' }}"><a href="{{ route('tickets.index') }}"><i class="im im-clipboard2"></i> Tickets</a></li>

                        </ul>

                    </div>

                    <div class="tab-pane {{ in_url('reports') ? 'active' : '' }}" id="reports" role="tabpanel">
                        <ul class="navigation">
                            <li class="navigation-header">Listagem</li>
                            <li ><a href="#"><i class="im im-file-text3"></i> Usuários</a></li>

                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>
