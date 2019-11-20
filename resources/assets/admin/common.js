window.slugGenerate = function (str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();
	var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
	var to   = "aaaaaeeeeeiiiiooooouuuunc------";
	for (var i=0, l=from.length ; i<l ; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}
	str = str.replace(/[^a-z0-9 -]/g, '')
	.replace(/\s+/g, '-')
	.replace(/-+/g, '-');
	return str;
}

window.parseFormError = function(errors) {
	for(parameter in errors) {
		$('[name=' + parameter + ']').addClass('is-invalid');
		$('#' + parameter + '-error').html(errors[parameter]);
	}
}

window.getUrlParameter = function() {
	var parameters = window.location.search.substring(1);
	if(parameters) return '?' + parameters;
	return parameters;
}

$(document).ready(function() {
	var notify = $('input.notify').val();
	var type = $('input.notify').data('type');
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	console.log(notify);
	if(notify) {
		switch(type) {
			case 'success':
				toastr.success(notify, 'Success');
				break;
			case 'error':
				toastr.error(notify, 'Error');
				break;
			default:
		}
	}
});