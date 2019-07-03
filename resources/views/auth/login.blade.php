@extends('layouts.auth')

@section('content')



<div class="col-md-5">
    <div class="card p-4">
        <div class="card-header text-center font-weight-light">
            <div class="text-secondary display-3">
                <i class="icon icon-user"></i>
            </div>

            <h5 class="text-uppercase">Login</h5>
            <span class="text-center text-muted">Insira suas credenciais abaixo</span>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="card-body">

                @include('alert::message')


                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" value="{{ old('email', '') }}" placeholder="E-mail">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0 text-muted"><i class="im im-user"></i></span>
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
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" value="{{ old('password', '') }}" placeholder="Senha">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0 text-muted"><i class="im im-lock2"></i></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-5">
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" class="styled" checked="checked"> Lembrar
                        </label>
                    </div>

                    <div class="col-sm-7 text-right">
                        <a href="{{ route('password.email') }}" class="text-primary">Esqueceu sua senha?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">Entrar <i class="im im-circle-right2"></i></button>

                <div class="float-right">
                    <br>
                    <br>
                    <br>
                    {{-- @include('elements.logos.svg_primeiro_02') --}}
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
