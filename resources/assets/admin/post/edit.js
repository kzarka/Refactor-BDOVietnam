"use strict"

var validator = null;

$(document).ready(function() {
    validator = $('form.validate').validate();
    CKEDITOR.replace('content');
    $('select[name=game]').select2({
        theme: 'bootstrap'
    });

    $('select[name=category]').select2({
        theme: 'bootstrap'
    });

    $('button.save').on('click', function(e) {
        e.preventDefault();
        callAjaxSave();
    })
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

function callAjaxSave() {
    validator.form();
    console.log(validator.valid());
    if(!validator.valid()) return;
    return;
	$.ajax({
        url: $('form.validate').attr('action'),
        type: $('form.validate').attr('method'),
        data: $("form.validate").serializeArray(),
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
}

function autoSave() {
    setInterval(callAjaxSave, 30000); // auto save every 5 minutes
}