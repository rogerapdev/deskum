@extends('layouts.auth')

@section('content')

<div class="col-md-6">
    <div class="card p-4">

        <div class="card-header text-center font-weight-light">
            <div class="text-danger display-3">
                <i class="icon icon-lock"></i>
            </div>
            <h5 class="text-uppercase">Alterar Senha</h5>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('password.reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

        <div class="card-body pt-0">

            <p><b>Cuidado</b>. Você está executando o processo de alteração de senha. Caso não tenha solicitado a alteração de senha, ignore esse procedimento</p>

            <hr class="hr-text mt-0" data-content="">


            @include('alert::message')


            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <input type="text" name="email" class="form-control" value="{{ old('email', '') }}" placeholder="E-mail">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-left-0 text-muted"><i class="icon icon-envelope"></i></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" value="{{ old('password', '') }}" placeholder="Nova Senha">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-left-0 text-muted"><i class="icon icon-lock"></i></span>
                        </div>
                    </div>
                    <span class="help-block text-muted"><small>Mínimo de 6 caracteres</small><br/></span>

                    @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation', '') }}" placeholder="Confirmar Senha">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-left-0 text-muted"><i class="icon icon-check"></i></span>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block text-danger">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                    @endif
                </div>
            </div>


            <button type="submit" class="btn btn-primary btn-block">Enviar <i class="im im-circle-right2"></i></button>

        </div>
        </form>

    </div>
</div>

@endsection
