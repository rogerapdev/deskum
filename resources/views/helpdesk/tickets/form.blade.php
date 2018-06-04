@extends('layouts.default')

@section('content')

@include('elements.asides.calls')

<div class="content-aside container-fluid">

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Ticket
                </div>
                <form class="form-horizontal" method="POST" action="{{ $ticket->id ? route('tickets.update', [Hasher::encode($ticket->id)]) : route('tickets.store') }}">
                {{ csrf_field() }}

                @if($ticket->id)
                    <input name="_method" type="hidden" value="PUT">
                @endif

                <div class="card-body">

                    <fieldset>
                        <legend>Solicitante:</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
                                    <input class="form-control" name="requester[name]" value="{{ old('requester.name', isset($ticket->requester) ? $ticket->requester->name : '') }}">
                                    @if ($errors->has('requester.name'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('requester.name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">E-mail: <span class="text-danger">*</span> </label>
                                    <input class="form-control" name="requester[email]" value="{{ old('requester.email', isset($ticket->requester) ? $ticket->requester->email : '') }}">
                                    @if ($errors->has('requester.email'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('requester.email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr/>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Assunto: <span class="text-danger">*</span> </label>
                                <input class="form-control" name="title" value="{{ old('title', $ticket->title) }}">
                                @if ($errors->has('title'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('title') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Projeto: <span class="text-danger">*</span> </label>
                                {{ Form::select('project_id', Dependency::optionsSelect('App\Models\Project'), $ticket->project_id, array('class' => 'form-control select-search')) }}
                                @if ($errors->has('project_id'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('project_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Conteúdo:</label>
                                <textarea class="form-control" rows="5" name="body">{{ old('body', $ticket->body) }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('body') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="{{ route('tickets.index') }}" class="btn btn-default" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-dark" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
                </div>
            </form>
            </div>
        </div>

    </div>

</div>


@endsection

@section('scripts')
@parent

<script type="text/javascript">

$(document).ready(function(){

    // $('textarea').summernote({height: 300});

});

</script>

@endsection
