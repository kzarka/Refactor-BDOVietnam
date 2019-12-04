window.slugGenerate = function (str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
    // remove accents, swap ñ for n, etc
    str = str.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    str = str.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    str = str.replace(/đ/gi, 'd');

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

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
	window.notify(null, notify, type);
	loadNotification(1);
});

window.notify = function(title = null, notify = null, type = null) {
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
	if(notify) {
		switch(type) {
			case 'success':
				toastr.success(notify, title || 'Success');
				break;
			case 'error':
				toastr.error(notify, title || 'Error');
				break;
			default:
		}
	}
}

window.notifySuccess = function(content = null, title = 'Success') {
	window.notify(title, content, 'success');
}

window.notifyError = function(content = null, title = 'Error') {
	window.notify(title, content, 'error');
}

function loadNotification(page) {
	$.ajax({
        url: NOTIFICATION_URL + '?page=' + page,
        type: 'GET',
        success: function(response) {
            if (response.status === 'SUCCESS') {
                parseNotification(response.data);
            } else if(response.status === 'ERROR') {
            	console.log('error');
            }
        },
        error: function (xhr, status, error) {

	    }
    });
}

function parseNotification(data) {
	var insertBefore = $('.dropdown-menu.notification').find('.dropdown-item.load-more');
	var rows = $('.dropdown-menu.notification').find('.dropdown-item.item');
	var row = rows.first().clone();
	for(var i = 0; i < data.length; i++) {
		if(rows.length == 1) {
			rows.remove();
		}
		row.find('.from').html(data[i].from);
		row.find('.to').html(data[i].to);
		row.find('.sentence').html(data[i].sentence);
		row.find('.time').html(data[i].time);
		row.clone().insertBefore(insertBefore);
	}
}

function loadMoreNotification() {
	$('.dropdown-menu.notification').on('click', '.dropdown-item.load-more', function() {

	});
}

