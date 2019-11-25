$(document).ready(function() {
	CKEDITOR.replace('content');
	$('select[name=game]').select2({
  		theme: 'bootstrap'
	});
	initSlug();
});

function initSlug() {
	$('form.validate').on('keyup', 'input[name=title]', function() {
		$('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
	});
}
