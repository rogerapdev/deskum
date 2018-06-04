@extends('layouts.default')

@section('content')

@include('elements.asides.settings')

<div class="content-aside container-fluid">

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Projeto
                </div>
                <form class="form-horizontal" method="POST" action="{{ $project->id ? route('projects.update', [Hasher::encode($project->id)]) : route('projects.store') }}">
                {{ csrf_field() }}

                @if($project->id)
                    <input name="_method" type="hidden" value="PUT">
                @endif

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
                                <input class="form-control" name="name" value="{{ old('name', $project->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="{{ route('projects.index') }}" class="btn btn-default" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-dark" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
                </div>
            </form>
            </div>
        </div>

    </div>

</div>


@endsection
