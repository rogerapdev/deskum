@extends('layouts.default')


@section('content')


@include('elements.asides.settings')

<div class="content-aside container-fluid">

	@include('alert::message')

	<div class="row">
		<div class="col-md-12">

			<div class="card">
			    <div class="card-header bg-light">
			        Usuários
			    </div>

			    <div class="card-actions">
			    	<a href="#" class="btn show-filters"><i class="icon-magnifier"></i></a>

			        <a href="{{ route('users.create') }}" class="btn btn-success">
			            <i class="fa fa-plus-circle"></i>
			        </a>
			    </div>

			    <div class="card-body">
			    	<fieldset class="filters pb-5" style="display: none;">
			    		<legend>Filtros</legend>
			    		<form class="form-horizontal" action="{{ route('users.index') }}" >

		                <div class="row">
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
	                                <input class="form-control" name="name" value="{{ session()->has('filters.name') ? session()->get('filters.name') : '' }}">
	                            </div>
	                        </div>
		                </div>
			    		<div class="row">
			    			<div class="col-md-12 text-right">
								<a href="{{ route('users.index') }}" class="btn btn-default" role="button">Limpar</a>
								<button type="submit" class="btn btn-dark" role="button">&nbsp;&nbsp;Enviar</button>
			    			</div>
			    		</div>
			    		</form>
			    	</fieldset>

			            <table class="table table-striped list-result">
			                <thead>
			                <tr>
			                    <th>Nome</th>
			                    <th>
									<div class="float-right font-weight-light">
										<a href="#" class="show-help-modal">
											<i class="im im-question3" aria-hidden="true"></i> Ajuda
										</a>
									</div>
			                    </th>
			                </tr>
			                </thead>
			                <tbody>
			                @forelse($users as $user)
			                <tr>
			                    <td class="text-nowrap">
			                    	{{ $user->name }}
			                    </td>
								<td class="text-right">

									<a href="#" class="btn pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu"></i></a>
									<div class="dropdown-menu dropdown-menu-right" style="text-transform: none;">
										<a class="dropdown-item" href="{{ route('users.edit', [Hasher::encode($user->id)]) }}"><i class="far fa-edit fa-1x"></i> Alterar</a>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete" data-token="{{ csrf_token() }}" data-method="delete" data-href="{{ route('users.delete', Hasher::encode($user->id) ) }}"><i class="text-danger far fa-times-circle fa-1x"></i> Remover</a>
									</div>

								</td>

			                </tr>
			                @empty
			                <tr>
			                	<td colspan="2">Nenhum registro foi encontrado</td>
			                </tr>
			                @endforelse

							@if(isset($links) and $links)
							<tr>
								<td colspan="2">
									{!! $links !!}
								</td>
							</tr>
							@endif

			                </tbody>
			            </table>

			    </div>
			</div>

		</div>
	</div>

</div>

@endsection
