@extends('layouts.default')

@section('content')

@include('elements.asides.settings')

<div class="content-aside container-fluid">

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Time
                </div>
                <form class="form-horizontal" method="POST" action="{{ $team->id ? route('teams.update', [Hasher::encode($team->id)]) : route('teams.store') }}">
                {{ csrf_field() }}

                @if($team->id)
                    <input name="_method" type="hidden" value="PUT">
                @endif

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nome: <span class="text-danger">*</span> </label>
                                <input class="form-control" name="name" value="{{ old('name', $team->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="text-danger">*</span> </label>
                                <input class="form-control" name="email" value="{{ old('email', $team->email) }}">
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Membros
                            <a href="#" id="add-member" class="float-right text-secondary">
                                <i class="far fa-plus-square fa-lg" style="text-transform: initial;"> Adicionar</i>
                            </a>
                        </legend>
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-9">
                                <label class="form-control-label">Usuário</label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-3">
                                <label class="form-control-label">Admin.</label>
                            </div>
                        </div>
                        <input type="hidden" name="index" value="1">
                        @if( isset($team) and $team->memberships->count())
                            @foreach($team->memberships as $key => $member)
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-9">
                                        @if( ($key + 1) >= 2)
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white border-right-0 text-danger" id="delete-member"><i class="im im-cross3"></i></span>
                                                </div>
                                                {{ Form::select('memberships[][user_id]', Dependency::optionsSelect('App\Models\User'), $member->user_id, array('class' => 'form-control select-search')) }}
                                            </div>
                                        @else
                                        <div class="form-group">
                                            {{ Form::select('memberships['.($key + 1).'][user_id]', Dependency::optionsSelect('App\Models\User'), $member->user_id, array('class' => 'form-control select-search')) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-3">
                                        <div class="form-group">
                                            <input type="radio" name="memberships[{{ ($key + 1) }}][admin]" value="1" {{ $member->admin ?  'checked="checked"' : '' }} class="styled">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-9">
                                <div class="form-group">
                                    {{ Form::select('memberships[1][user_id]', Dependency::optionsSelect('App\Models\User'), '', array('class' => 'form-control select-search')) }}
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-3">
                                <div class="form-group">
                                    <input type="radio" name="memberships[1][admin]" value="1" class="styled">
                                </div>
                            </div>
                        </div>
                        @endif
                    </fieldset>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="{{ route('teams.index') }}" class="btn btn-default" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-dark" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
                </div>
            </form>
            </div>
        </div>

    </div>

</div>
@include('helpdesk.teams._member_template')


@endsection


@section('scripts')
@parent

<script type="text/javascript">

$(document).ready(function(){


    $('#add-member').on("click", function(event) {
        event.preventDefault();

        var father = $(this).parents('fieldset');
        var template = $('.members-template');
        father.append(template.html());

        var last = father.find('.row').last();
        // console.log(last);

        var index = parseInt($('input[name=index]').val(), 10) + 1;

        var element = last.find('select');
        element.attr('name', 'memberships['+index+'][user_id]');
        console.log(element);

        element.select2({
            "language": "pt-BR",
            theme: "bootstrap4"
        });

        var element = last.find('input');
        element.attr('name', 'memberships['+index+'][admin]');
        // element.addClass('styled');

        $('form input[type="radio"]').iCheck('destroy');

        $('form input[type="radio"]').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });

        $('input[name=index]').val(index);

    });
    $(document).on('ifChecked', 'form input[type="radio"]', function() {
        // console.log($(this).is(':checked'));

        $('form input[type="radio"]').not(this).iCheck('uncheck');
    });

    $(document).on("click", '#delete-member', function(event) {
        event.preventDefault();

        $(this).closest('.row').remove();
    });


});
</script>

@endsection
