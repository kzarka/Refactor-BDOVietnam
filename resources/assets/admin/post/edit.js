"use strict"

var validator = null;
var form = null;

$(document).ready(function() {
    initFormSave();
    CKEDITOR.replace('content');
    $('select[name=game]').select2({
        theme: 'bootstrap'
    });

    $('select[name="category[]"]').select2({
        theme: 'bootstrap'
    }).val(selected_categories).trigger('change');

    $('button.save').on('click', function(e) {
        e.preventDefault();
        $('form.validate').submit();
    });

    $('button.preview').on('click', function(e) {
        e.preventDefault();
        $('form.preview').find('[name=content]').val(CKEDITOR.instances.content.getData());
        $('form.preview').find('[name=title]').val($('form.validate').find('[name=title]').val())
        $('form.preview').submit();
    });

    initSlug();
    initToggleState();
    setTimeout(autoSave, 60000); // Start auto save after 1 minute
});

function initSlug() {
    $('form.validate').on('keyup', 'input[name=title]', function() {
        $('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
    });
}

function initToggleState() {
    $('form.validate input.public').on('click', function () {
        if($(this).prop('checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });
}

function triggerSave() {
    $('form.validate').submit();
}

function initFormSave() {
    form = $('form.validate').validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: $(form).serializeArray(),
                success: function(response) {
                    if (response.status === 'SUCCESS') {
                        notifySuccess('Saved!');
                    } else if(response.status === 'ERROR') {
                        notifyError(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    if(response.errors) {
                        notifyError('Some fields is not valid');
                        parseFormError(response.errors);
                    } else {
                        $notifyError('System error.');
                    }
                }
            });
            return false;
        }
    });
}

function autoSave() {
    setInterval(triggerSave, 30000); // auto save every 5 minutes
}