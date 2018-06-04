@extends('layouts.auth')

@section('content')

<div class="col-md-6">
    <div class="card p-4">

        <div class="card-header text-center font-weight-light">
            <div class="text-warning display-3">
                <i class="icon icon-refresh"></i>
            </div>
            <h5 class="text-uppercase">Recuperar Senha</h5>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('password.send') }}">
            {{ csrf_field() }}

        <div class="card-body pt-0">

            <p>Esqueceu sua senha. Informe o seu e-mail que enviaremos as instruções necessárias para recuperar sua senha.</p>

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

            <button type="submit" class="btn btn-primary btn-block">Enviar <i class="im im-circle-right2"></i></button>


        </div>
        </form>

    </div>
</div>

@endsection
