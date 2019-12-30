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
	initToc();
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

function initToc() {
	var insertAfter = $('article').find('p').first();

	var content = '';

	var headers = $('article').find('h2, h3, h4');
	if(headers.length == 0) return;
	content = `<div id="toc" class="toc">
	<input type="checkbox" role="button" id="toctogglecheckbox" class="toctogglecheckbox" style="display:none">
	<div class="toctitle" lang="vi" dir="ltr"><h2>Mục lục</h2><span class="toctogglespan">
	<label class="toctogglelabel" for="toctogglecheckbox"></label></span></div><ul>`;
	var previosNode = null;
	var index = [];
	var grade = 0;
	index[grade] = 1;
	for(var i = 0; i < headers.length; i++) {
		var header = $(headers[i]).first();
		var string = header.text();
		// add id value to jump
		var slug = slugGenerate(string);
		header.attr('id', slug);
		var currentNode = header[0].localName;
		// first node
		if(!previosNode) {
			content += `<li><a href="#${slug}"><span class="tocnumber">${getIndex(index, grade)}</span> <span class="toctext">${string}</span></a>`;
			previosNode = currentNode;
			continue;
		}

		if(currentNode == previosNode) {
			index[grade]++;
			content += `</li><li><a href="#${slug}"><span class="tocnumber">${getIndex(index, grade)}</span> <span class="toctext">${string}</span></a>`;
			previosNode = currentNode;
			continue;
		}

		if(currentNode > previosNode) {
			index[++grade] = 1;
			content += `<ul><li><a href="#${slug}"><span class="tocnumber">${getIndex(index, grade)}</span> <span class="toctext">${string}</span></a>`;
			previosNode = currentNode;
			continue;
		}

		if(currentNode < previosNode) {
			delete index[grade];
			grade--;
			index[grade]++;
			content += `</ul></li><li><a href="#${slug}"><span class="tocnumber">${getIndex(index, grade)}</span> <span class="toctext">${string}</span></a>`;
			previosNode = currentNode;
			continue;
		}
	}

	content += '</li></ul></div>';
	$(content).insertAfter(insertAfter);
}

function slugGenerate(str) {
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

function getIndex(index, grade) {
	var result = '';
	for(var i = 0; i <= grade; i++) {
		result += index[i] + '.'
	}
	return result.slice(0, -1);
}