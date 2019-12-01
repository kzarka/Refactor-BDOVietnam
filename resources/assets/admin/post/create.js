$(document).ready(function() {
	CKEDITOR.replace('content');
	$('select[name=game]').select2({
  		theme: 'bootstrap'
	});

	$('select[name="category[]"]').select2({
  		theme: 'bootstrap'
	});

	$('button.save').on('click', function() {
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
