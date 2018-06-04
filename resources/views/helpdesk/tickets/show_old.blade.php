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

						<h6 class="text-semibold"><i class="im im-pencil7"></i> Criar comentário</h6>
						<!-- Basic layout-->
						<form action="{{ route('tickets.comment', [Hasher::encode($ticket->id)]) }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="row">
								<div class="col-md-12">
									<textarea class="form-control" rows="5" name="message">{{ old('message','') }}</textarea>
								</div>
							</div>

							<div class="text-right pt-3">
								<button type="submit" class="btn btn-dark"><i class="im im-plus22"></i>Adicionar</button>
							</div>

						</form>
						<!-- /basic layout -->


	<div class="row">
		<div class="comments col-md-9" id="comments">
			{{-- <h3 class="mb-2">Comments</h3> --}}
			<!-- comment -->
			<div class="comment mb-2 row">
				<div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
					<a href=""><img class="mx-auto rounded-circle img-fluid" src="http://demos.themes.guide/bodeo/assets/images/users/m103.jpg" alt="avatar"></a>
				</div>
				<div class="comment-content col-md-11 col-sm-10">
					<h6 class="small comment-meta"><a href="#">admin</a> Today, 2:38</h6>
					<div class="comment-body">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <a href>http://wwwwww.com</a> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
							<br>
							<a href="" class="text-right small"><i class="ion-reply"></i> Reply</a>
						</p>
					</div>
				</div>
				<!-- reply is indented -->
				<div class="comment-reply col-md-11 offset-md-1 col-sm-10 offset-sm-2">
					<div class="row">
						<div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
							<a href=""><img class="mx-auto rounded-circle img-fluid" src="http://demos.themes.guide/bodeo/assets/images/users/m101.jpg" alt="avatar"></a>
						</div>
						<div class="comment-content col-md-11 col-sm-10 col-12">
							<h6 class="small comment-meta"><a href="#">phildownney</a> Today, 12:31</h6>
							<div class="comment-body">
								<p>Really?? Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
									<br>
									<a href="" class="text-right small"><i class="ion-reply"></i> Reply</a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!-- /reply is indented -->
			</div>
			<!-- /comment -->
			<!-- comment -->
			<div class="comment mb-2 row">
				<div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
					<a href=""><img class="mx-auto rounded-circle img-fluid" src="http://demos.themes.guide/bodeo/assets/images/users/w102.jpg" alt="avatar"></a>
				</div>
				<div class="comment-content col-md-11 col-sm-10">
					<h6 class="small comment-meta"><a href="#">maslarino</a> Yesterday, 5:03 PM</h6>
					<div class="comment-body">
						<p>Sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
							<br>
							<a href="" class="text-right small"><i class="ion-reply"></i> Reply</a>
						</p>
					</div>
				</div>
			</div>
			<!-- /comment -->
		</div>
	</div>
</div>

					</div>
				</div>
			</div>
		</div>




@endsection
