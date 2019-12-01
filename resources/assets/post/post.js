"use strict"

var selectedRow = null;

$(document).ready(function() {
	$('button.submit').on('click', function() {
		$(this).closest('form').submit();
	});

	if($(window.location.hash).length > 0){
        $('#sitewrap').animate({ scrollTop: $(window.location.hash).offset().top}, 1000);
	}
	initReplyAction();

});

function initReplyAction() {
	$('.comment-reply-link').on('click', function(e) {
		e.preventDefault();
		var parent_id = $(this).closest('li').data('id');

		var insertAfter = $(this).closest('li.depth-1');
		var form = $('#respond').detach();
		var author = $(this).closest('div.comment-author-inner').find('span.comment-author').html();
		$(form).find('input[name=parent_id]').val(parent_id);
		$(form).insertAfter(insertAfter);
		$(form).find('textarea').attr('placeholder', 'Đang trả lời ' + author + ' ..*');
		$(form).find('textarea').focus();
		$('#cancel-comment-reply-link').show();
	});

	$('#cancel-comment-reply-link').on('click', function() {
		$(this).hide();
		var form = $('#respond').detach();
		var insertAfter = $('ol.commentlist');
		$(form).find('input[name=parent_id]').val('');
		$(form).find('textarea').attr('placeholder', 'Bạn nghĩ gì về bài viết này..*');
		$(form).insertAfter(insertAfter);
	});
}
