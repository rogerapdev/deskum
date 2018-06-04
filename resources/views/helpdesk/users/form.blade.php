@extends('layouts.default')

@section('content')

@include('elements.asides.settings')

<div class="content-aside container-fluid">

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Usuário
                </div>
                <form class="form-horizontal" method="POST" action="{{ $user->id ? route('users.update', [Hasher::encode($user->id)]) : route('users.store') }}">
                {{ csrf_field() }}

                @if($user->id)
                    <input name="_method" type="hidden" value="PUT">
                @endif

                <div class="card-body">


<div class="row mb-5">
    <div class="col-md-4 mb-4">
        <div>Informação do Perfil</div>
        {{-- <div class="text-muted small">These information are visible to the public.</div> --}}
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
                    <input class="form-control" name="name" value="{{ old('name', $user->name) }}">
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-control-label">E-mail: <span class="text-danger">*</span> </label>
                    <input class="form-control" name="email" value="{{ old('email', $user->email) }}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="admin" value="1" class="styled" {{ old('admin', $user->admin) ?  'checked="checked"' : '' }}> Administrador
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="assistant" value="1" class="styled" {{ old('assistant', $user->assistant) ?  'checked="checked"' : '' }}> Assistente
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div>Credenciais de Acesso</div>
        <div class="text-muted small">Deixe os campos de credenciais vazio se você não quiser alterar a senha.</div>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-control-label">Senha: <span class="text-danger">*</span> </label>
                    <input class="form-control" type="password" name="password" value="">
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-control-label">Confirmar</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>


                </div>

                <div class="card-footer bg-light text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-default" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-dark" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
                </div>
            </form>
            </div>
        </div>

    </div>

</div>


@endsection
