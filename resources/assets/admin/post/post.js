"use strict"

var selectedRow = null;

$(document).ready(function() {
	initDeleteModal();
	initApproveModal();
});

function initDeleteModal() {
	$('table tbody').on('click', 'button.delete', function() {
		selectedRow = $(this).closest('tr');
		$('#p_delete').modal('show');
	});

	$('#confirm_delete').on('click', function() {
		selectedRow.find('form.delete').submit();
	})
}

function initApproveModal() {
	$('table tbody').on('click', 'button.approve', function() {
		selectedRow = $(this).closest('tr');
		$('#p_approve').modal('show');
	});

	$('#confirm_approve').on('click', function() {
		selectedRow.find('form.approve').submit();
	})
}
