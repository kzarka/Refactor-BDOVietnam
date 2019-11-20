"use strict"

var form = null;
var selectedRow = null;
$(document).ready( function() {
	initEditModal();
	initDeleteModal();
	initCreateModal();
	initSaveForm();
	initSlug();
	$('#g_form').on('hidden.bs.modal', function() {
		form.resetForm();
		$(this).find('input').val('').removeClass("is-invalid").removeClass("is-valid");
		$(this).find('input').find('input[name=status]').prop('checked', true);
		$(this).find('div.form-group').removeClass("is-submitted");
	});

	$('button.submit').on('click', function(e) {
		e.preventDefault();
		$('form.validate').submit();
	});
});

function initEditModal() {
	$('table tbody').on('click', 'button.edit', function() {
		var row = $(this).closest('tr');
		$('form.validate').attr('action', BASE_API + '/' + row.data('id')).attr('method', 'PUT');
		$('form.validate').find('input[name=name]').val(row.find('td.name').html());
		$('form.validate').find('input[name=thumbnail]').val(row.find('td.thumbnail').find('img').attr('src'));
		$('form.validate').find('input[name=slug]').val(row.find('td.slug').html());
		var active = row.find('td.active').find('span').data('active');
		$('form.validate').find('input[name=active]').prop('checked', !!active);
		$('#g_form').modal('show');
	});
}

function initDeleteModal() {
	$('table tbody').on('click', 'button.delete', function() {
		selectedRow = $(this).closest('tr');
		$('#g_delete').modal('show');
	});

	$('#confirm_delete').on('click', function() {
		selectedRow.find('form').submit();
	})
}

function initCreateModal() {
	$('button.create').on('click', function() {
		$('form.validate').attr('action', BASE_API).attr('method', 'POST');
		$('#g_form').modal('show');
	});
}

function initSaveForm() {
	form = $('form.validate').validate({
		submitHandler: function(form) {
			var values = $("form.validate").serializeArray();
		    values = values.concat(
	            $('form.validate input[type=checkbox]:not(:checked)')
	            .map(function() {return {"name": this.name, "value": 0}}).get()
		    ).concat(
	            $('form.validate input[type=checkbox]:checked')
	            .map(function() {return {"name": this.name, "value": 1}}).get()
		    );
			$.ajax({
	            url: $(form).attr('action'),
	            type: $(form).attr('method'),
	            data: values,
	            success: function(response) {
	                if (response.status === 'SUCCESS') {
	                    $('#g_form').modal('hide');
	                    reloadItems();
	                } else if(response.status === 'ERROR') {
	                    $('#g_form').find('label.server-error').html(response.message);
	                }
	            },
	            error: function (xhr, status, error) {
			        var response = JSON.parse(xhr.responseText);
			        if(response.errors) {
			        	parseFormError(response.errors);
			        } else {
			        	$('#g_form').find('label.server-error').html('System error');
			        }
			    }
	        });
	        return false;
		}
	});
}

function initSlug() {
	$('form.validate').on('keyup', 'input[name=name]', function() {
		$('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
	});
}

function reloadItems() {
	$.ajax({
        url: BASE_API + '/load' + getUrlParameter(),
        success: function(response) {
            if (response.status === 'SUCCESS') {
                parseTableRow(response.data.data);
            } else if(response.status === 'ERROR') {
                $('#error_popup').modal('show');
            }
        },
        error: function (xhr, status, error) {
	        var response = JSON.parse(xhr.responseText);
	        $('#error_popup').modal('show');
	    }
    });
}

function parseTableRow(data) {
	let row = $('table tbody').find('tr').first().clone();
	row.removeClass('hidden');
	$('table').find('tbody').empty();
	for(var key in data) {
		var item = data[key];
		row.data('id', item.id);
		row.find('.thumbnail').html('');
		if(item.thumbnail) {
			row.find('.thumbnail').html('<img class="image" src="' + item.thumbnail + '" />');
		}
		row.find('.name').html(item.name);
		row.find('.slug').html(item.slug);
		row.find('.register').html(item.created_at);
		if(item.active) {
			row.find('.active').html('<span class="badge badge-success" data-active="1">Active</span>');
		} else {
			row.find('.active').html('<span class="badge badge-danger" data-active="0">Disabled</span>')
		}
		$('table').find('tbody').append(row.clone());
	}
}