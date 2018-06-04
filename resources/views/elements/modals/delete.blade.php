<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger border-0">
                <h5 class="modal-title text-white">Excluindo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-2">
                <h4>Você tem certeza?</h4>
                <p>Você realmente deseja <strong>excluir</strong> esse registro? Este processo não pode ser desfeito.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link border bg-light" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnYes" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>
</div>


@section('scripts')
@parent
<script type="text/javascript">
    var link_ref = '';
    $('#modal-delete').on('show.bs.modal', function(e) {
        link_ref = $(e.relatedTarget);
    });

    $('#modal-delete button[id=btnYes]').on('click', function() {

        var link = link_ref;
        var httpMethod = link.data('method').toUpperCase();
        var form;

        // If the data-method attribute is not PUT or DELETE,
        // then we don't know what to do. Just ignore.
        if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
            return;
        }

        var form = $('<form>', {
                'method': 'POST',
                'action': link.data('href')
            });

        var token = $('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': link.data('token') // hmmmm... '<?php echo csrf_token(); ?>'
            });

        var hiddenInput = $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': link.data('method')
            });

        form.append(token, hiddenInput).appendTo('body');
        form.submit();
        e.preventDefault();
        link_ref = '';
    });
</script>

@endsection