function validate(my_form, name_class, url_route) {
        // alert('aqui');
        var validated = false;
        var data = my_form.serializeArray();
        data.push({
                name: 'class',
                value: name_class
        });
        for (var i = 0; i < data.length; i++) {
                item = data[i];
                if (item.name == '_method') {
                        data.splice(i, 1);
                }
        }
        console.log(data);
        my_form.find('.help-block.text-danger').remove();

        $.ajax({
                url: url_route,
                type: 'post',
                global: false,
                async: false,
                data: $.param(data),
                dataType: 'json',
                success: function(data) {
                        console.log(data);
                        if (data.success) {
                                clear_validate(my_form);
                                validated = true;
                        } else {

                                clear_validate(my_form);
                                $.each(data.errors, function(key, data) {
                                        var field = my_form.find("[name='" + undot(key) + "']");
                                        var father = field.parents('.form-group');
                                        father.find('.help-block.text-danger').remove();

                                        father.append('<span class="help-block text-danger"> ' + data[0] + '</span>');
                                });

                                validated = false;
                        }
                },
                error: function(xhr) {
                        console.log(xhr.status);
                        var data = xhr.responseJSON;

                        clear_validate(my_form);
                        $.each(data.errors, function(key, data) {
                                var field = my_form.find("[name='" + undot(key) + "']");
                                var father = field.parents('.form-group');
                                father.find('.help-block.text-danger').remove();

                                father.append('<span class="help-block text-danger"> ' + data[0] + '</span>');
                        });
                        // unblockPage();
                },
                complete: function() {
                        // unblockPage();
                },
                beforeSend: function() {
                        // blockPage('aguarde...');
                }
        });
        return validated;
}


function clear_validate(my_form)
{
        $.each(my_form.serializeArray(), function(i, field) {
                var field = my_form.find("[name='" + field.name + "']");
                var father = field.parent('.form-group');
                father.find('.help-block.text-danger').remove();
        });
        my_form.find('.help-block.text-danger').remove();
}


function undot(string)
{
    return string.replace(/[.]([^.]+)/g, '[$1]');
}