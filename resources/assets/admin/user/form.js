"use strict"

var selectedRow = null;

$(document).ready(function() {
	$('button.save').on('click', function(e) {
        e.preventDefault();
        $('form.validate').submit();
    });

	$('form.validate').validate({
		rules: {
			avatar: {
  				extension: "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF",
  				maxsize: 2097152
			}
		}
	});

	$('input[name=avatar]').change(function() {
	  	readURL(this);
	});

	initToggleState();
	selectAvatar();
});

function initToggleState() {
    $('form.validate input.active').on('click', function () {
        if($(this).prop('checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });
}

function selectAvatar() {
	$('button.select').on('click', function() {
		$('input[name=avatar]').trigger('click');
	});

	$('.photo-frame').on('click', function() {
		$('img.preview').attr('src', $(this).find('img').attr('src'));
		$('#u_preview').modal('show');
	});
}

function readURL(input) {
  	if(input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      	$('img.select_photo').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}