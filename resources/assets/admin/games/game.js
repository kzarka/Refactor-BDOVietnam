"use strict"

var form = null;
$(document).ready( function() {
	initEditModal();
	initDeleteModal();
	initCreateModal();
	initSaveForm();
	initSlug();
	$('#g_form').on('hidden.bs.modal', function() {
		form.resetForm();
		$(this).find('input').val('').removeClass("is-invalid");
		$(this).find('input').find('input[name=status]').prop('checked', true);
		$(this).find('div.form-group').removeClass("is-invalid");
	});

	$('button.submit').on('click', function(e) {
		e.preventDefault();
		$('form.validate').submit();
	});
});

function initEditModal() {
	$('button.edit').on('click', function() {
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
	$('button.delete').on('click', function() {
		$('#g_delete').modal('show');
	});
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
	            	console.log('Success');
	                if (response.success === true) {
	                    
	                } else {
	                    
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