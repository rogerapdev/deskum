@extends('layouts.default')


@section('content')

@include('elements.asides.records')

<div class="content-aside container-fluid">

	@include('alert::message')

	<div class="row">
		<div class="col-md-12">

			<div class="card">
			    <div class="card-header bg-light">
			        Listagem de Veículos
			    </div>

				<form class="form-horizontal" method="POST" action="{{ route('vehicles.reports.listing') }}">
                {{ csrf_field() }}

			    <div class="card-body">

	                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
                                <input class="form-control" name="name" value="">
                            </div>
                        </div>

	                </div>

			    </div>
                <div class="card-footer bg-light text-right">
                    <button type="submit" class="btn btn-primary" role="button">&nbsp;&nbsp;Gerar Relatório</button>
                </div>
                </form>
			</div>

		</div>
	</div>
</div>

@endsection
