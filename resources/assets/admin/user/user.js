"use strict"

var selectedRow = null;

$(document).ready(function() {
	initDeleteModal();
	initStatusModal();
});

function initDeleteModal() {
	$('table tbody').on('click', 'button.delete', function() {
		selectedRow = $(this).closest('tr');
		$('#u_delete').modal('show');
	});

	$('#confirm_delete').on('click', function() {
		selectedRow.find('form.delete').submit();
	})
}

function initStatusModal() {
	$('table tbody').on('click', 'button.ban', function() {
		selectedRow = $(this).closest('tr');
		$('form.ban').find('[name=user_id]').val(selectedRow.data('id'));
		$('#u_ban').modal('show');
	});

	$('#confirm_ban').on('click', function() {
		selectedRow.find('form.ban').submit();
	});
}