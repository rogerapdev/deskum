@extends('layouts.default')

@section('content')

@include('elements.asides.calls')

<div class="content-aside container-fluid">

		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-light">
						Ticket - #{{ $ticket->public_token }}
					</div>
					<div class="card-body">

						<h6 class="text-semibold">Visão Geral</h6>
						<div class="row container-fluid">
							<div class="col-sm-6 mb-4">
								<table>
									<tr>
										<td class="font-weight-bold pr-3 pb-2">Projeto:</td>
										<td>{{ $ticket->project->name }}</td>
									</tr>
									<tr>
										<td class="font-weight-bold pr-3 pb-2">Criado em:</td>
										<td>{{ Date::make($ticket->created_at)->format('j F Y - H:m') }}</td>
									</tr>
									<tr>
										<td class="font-weight-bold pr-3 pb-2 align-text-top">Solicitante:</td>
										<td>{{ $ticket->requester->name }}<br/> {{ $ticket->requester->email }}</td>
									</tr>
									<tr>
										<td class="font-weight-bold pr-3 pb-2">Assunto:</td>
										<td>{{ $ticket->title }}</td>
									</tr>
									<tr>
										<td class="font-weight-bold pr-3 pb-2">Horas/Criado:</td>
										<td>{{ Date::make($ticket->created_at)->diffForHumans(null, true) }}</td>
									</tr>
								</table>

							</div>
						</div>

						<h6 class="text-semibold">Conteúdo</h6>
						<p class="content-group pl-3">{{ $ticket->body }}</p>

					</div>
					<div class="card-header bg-light border-bottom border-top font-italic">
						Comentários
					</div>
					<div class="card-body">

						<div class="container">

							@if(!in_array($ticket->status, ['closed']))
							<!-- Basic layout-->
							<form action="{{ route('tickets.comment', [Hasher::encode($ticket->id)]) }}" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="row">
									<div class="col-md-6">
										<h6 class="text-semibold"><i class="im im-pencil7"></i> Criar comentário</h6>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="new_status" class="col-sm-2 col-form-label">Situação:</label>
											<div class="col-sm-10">
												{{ Form::select('new_status', Dependency::optionsRepository('App\Repositories\TicketRepository', 'optionsStatus'), $ticket->status, array('class' => 'form-control select-search')) }}
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<textarea class="form-control" rows="5" name="body">{{ old('body','') }}</textarea>
										@if ($errors->has('body'))
											<span class="help-block text-danger">
												{{ $errors->first('body') }}
											</span>
										@endif
									</div>
								</div>

								<div class="row pt-3">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn btn-dark"><i class="im im-plus22"></i>Adicionar</button>
									</div>
								</div>

							</form>
							<!-- /basic layout -->
							<hr/>
							@endif


							<div class="row">
								<div class="comments col-md-9" id="comments">

									@foreach($ticket->comments->sortByDesc('created_at') as $comment)
										<!-- comment -->
										<div class="comment mb-2 row">
											<div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
												<a href=""><img class="mx-auto rounded-circle img-fluid" src="http://via.placeholder.com/50x50" alt="avatar"></a>
											</div>
											<div class="comment-content col-md-11 col-sm-10">
												<h6 class="small comment-meta"><span class="text-primary">{{ $comment->user->name }}</span> {{ Date::make($comment->created_at)->diffForHumans() }}</h6>
												<div class="comment-body">
													<p>
														{{ $comment->body }}
													</p>
												</div>
											</div>
										</div>
										<!-- /comment -->
									@endforeach
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>




@endsection
