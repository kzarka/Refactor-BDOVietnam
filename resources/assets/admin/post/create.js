$(document).ready(function() {
	CKEDITOR.replace('content');
	$('select[name=game]').select2({
  		theme: 'bootstrap'
	});

	$('select[name=category]').select2({
  		theme: 'bootstrap'
	});

	$('button.save').on('click', function() {
		$('form.validate').submit();
	})
	initSlug();
});

function initSlug() {
	$('form.validate').on('keyup', 'input[name=title]', function() {
		$('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
	});
}
