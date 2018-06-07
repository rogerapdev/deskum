@extends('layouts.default')


@section('content')


@include('elements.asides.calls')

<div class="content-aside container-fluid">

	@include('alert::message')

	<div class="row">
		<div class="col-md-12">

			<div class="card">
			    <div class="card-header bg-light">
			        Tickets
			    </div>

			    <div class="card-actions">
			    	<a href="#" class="btn show-filters"><i class="icon-magnifier"></i></a>

			        <a href="{{ route('tickets.create') }}" class="btn btn-success">
			            <i class="fa fa-plus-circle"></i>
			        </a>
			    </div>

			    <div class="card-body">
			    	<fieldset class="filters pb-5" style="display: none;">
			    		<legend>Filtros</legend>
			    		<form class="form-horizontal" action="{{ route('tickets.index') }}" >

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
								<a href="{{ route('tickets.index') }}" class="btn btn-default" role="button">Limpar</a>
								<button type="submit" class="btn btn-dark" role="button">&nbsp;&nbsp;Enviar</button>
			    			</div>
			    		</div>
			    		</form>
			    	</fieldset>

			    	<div class="row list-result">
			    		<div class="col-md-12">
							<div class="float-right font-weight-light">
								<a href="#" class="show-help-modal">
									<i class="im im-question3" aria-hidden="true"></i> Ajuda
								</a>
							</div>
							<hr class="mt-4">

							@foreach ($tickets->chunk(3) as $chunk)
							<div class="row">
								@foreach ($chunk as $ticket)
								<div class="col-md-6">
									<div class="card card-border" style="font-size: 13px;">
										<div class="card-body px-2 py-2">
											<div class="row">
												<div class="col-md-8">
													<h6 class="mt-0"><a href="{{ route('tickets.read', [Hasher::encode($ticket->id)]) }}" class="text-primary font-weight-bold">#{{ $ticket->public_token }} - {{ $ticket->title }}</a></h6>
													<p class="mb-15">{!! str_limit(strip_tags($ticket->body), 100) !!}</p>
													<ul class="pl-2">
														<li><b>Solicitante:</b> {{ $ticket->requester->name }}</li>
														<li><b>Técnico:</b> &nbsp;---------</li>
													</ul>
												</div>

												<div class="col-md-4">
													<ul class="pl-2">
														<li>{{ Date::make($ticket->created_at)->format('j F Y') }}</li>
														<li class="dropdown">
											        		Prioridade: &nbsp;
											        		<label class="font-weight-bold bg-danger text-white px-1">Urgente</label>
														</li>
														<li><span class="font-weight-bold">{{ $ticket->project->name }}</span></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="card-footer bg-light px-1 py-1 ml-1">
											<div class="row">
												<div class="col-md-8 col-sm-6 col-6">
													<span>Horas/Criado: {{ Date::make($ticket->created_at)->diffForHumans(null, true) }}</span>
												</div>
												<div class="col-md-4 col-sm-6 col-6 text-right">
													<span class="font-weight-bold">{{ $optionsStatus[$ticket->status] }}</span>
													<div class="btn-group">
													<a href="#" class="btn pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-menu"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="#" class="dropdown-item">Mesclar</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="{{ route('tickets.edit', [Hasher::encode($ticket->id)]) }}"><i class="far fa-edit fa-1x"></i> Alterar</a>
														<a href="#" class="dropdown-item"><i class="text-danger far fa-times-circle fa-1x"></i> Remover</a>
													</div>
													</div>

												</div>
											</div>

										</div>
									</div>
								</div>
								@endforeach
							</div>

							@endforeach

							<div class="row">
								<div class="col-md-6">
									<div class="card card-border card-border-danger" style="font-size: 13px;">
										<div class="card-body">
											<div class="row">
												<div class="col-md-8">
													<h6 class="mt-0"><a href="#" class="text-primary font-weight-bold">#99SQAVK - Segundo teste de atendimento</a></h6>
													<p class="mb-15">Como devo criar um funcionário administrador</p>
													<ul class="pl-2">
														<li><b>Solicitante:</b> &nbsp;realiza - </li>
														<li><b>Técnico:</b> &nbsp;---------</li>
													</ul>
												</div>

												<div class="col-md-4">
													<ul class="pl-2">
														<li>23 fevereiro 2018</li>
														<li class="dropdown">
											        		Prioridade: &nbsp;
											        		<label class="font-weight-bold bg-danger text-white px-1">Urgente</label>
														</li>
														<li><span class="font-weight-bold">Pergunta</span></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card card-border card-border-success" style="font-size: 13px;">
										<div class="card-body">
											<div class="row">
												<div class="col-md-8">
													<h6 class="mt-0"><a href="#" class="text-primary font-weight-bold">#99SQAVK - Segundo teste de atendimento</a></h6>
													<p class="mb-15">Como devo criar um funcionário administrador</p>
													<ul class="pl-2">
														<li><b>Solicitante:</b> &nbsp;realiza - </li>
														<li><b>Técnico:</b> &nbsp;---------</li>
													</ul>
												</div>

												<div class="col-md-4">
													<ul class="pl-2">
														<li>23 fevereiro 2018</li>
														<li class="dropdown">
											        		Prioridade: &nbsp;
											        		<label class="font-weight-bold bg-success text-white px-1">Urgente</label>
														</li>
														<li><span class="font-weight-bold">Pergunta</span></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							@if(isset($links) and $links)
							<hr>
							<div class="row">
								<div class="col-md-12">
									{!! $links !!}
								</div>
							</div>
							@endif
			    		</div>
			    	</div>




			    </div>
			</div>

		</div>
	</div>

</div>

@endsection
