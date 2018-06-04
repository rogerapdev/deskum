<aside class="page-aside">
    <div class="be-scroller" data-simplebar="init">
        <div class="aside-content">
            <div class="content">
                <div class="aside-header">
                    <button data-target=".aside-nav" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="im im-arrow-down5"></span>
                    </button>
                    <span class="title">Configurações</span>
                    <p class="description text-muted small">Configurações gerais do sistema</p>
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
                            <li class="{{ active_url('settings') }}"><a href="{{ route('dashboard.settings') }}"><i class="icon-home"></i> Painel</a></li>
                            <li class="navigation-header">Geral</li>
                            <li class="{{ (in_url('projects') and !in_url('reports')) ? 'active' : '' }}"><a href="{{ route('projects.index') }}"><i class="im im-stack4"></i> Projetos</a></li>
                            <li class="{{ (in_url('teams') and !in_url('reports')) ? 'active' : '' }}"><a href="{{ route('teams.index') }}""><i class="icon-people"></i> Times</a></li>
                            <li class="{{ (in_url('users') and !in_url('reports')) ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="icon-user"></i> Usuários</a></li>
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
