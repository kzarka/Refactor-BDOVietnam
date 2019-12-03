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

    $('form.validate').validate({
		rules: {
			images: {
  				extension: "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF",
  				maxsize: 2097152
			}
		}
	});

	initSlug();
	initToggleState();
	initSelectImage();
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

function initSelectImage() {

	$('.add-image').on('click', function() {
    	$('input[name=images]').trigger('click');
    });

	$('input[name=images]').change(function() {
	  	readURL(this);
	});

	$('.close-icon').on('click',function() {
		$('#p_remove_image').modal('show');
	});

	$('#confirm_remove').on('click', function() {
		$('input[name=images]').val('');
		$('.cover-image-button.images').addClass('hidden');
	});

	$('.photo-frame').on('click', function() {
		$('#p_preview_image').find('img').attr('src', $(this).find('img').attr('src'));
		$('#p_preview_image').modal('show');
	});
}

function readURL(input) {
  	if(input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	    	$('.cover-image-button.images').removeClass('hidden');
	      	$('.cover-image-button.images').find('img').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	}
}
