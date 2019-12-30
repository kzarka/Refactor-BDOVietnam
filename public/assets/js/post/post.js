/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/post/post.js":
/*!***************************************!*\
  !*** ./resources/assets/post/post.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var selectedRow = null;
$(document).ready(function () {
  $('button.submit').on('click', function () {
    $(this).closest('form').submit();
  });

  if ($(window.location.hash).length > 0) {
    $('#sitewrap').animate({
      scrollTop: $(window.location.hash).offset().top
    }, 1000);
  }

  initReplyAction();
  initToc();
});

function initReplyAction() {
  $('.comment-reply-link').on('click', function (e) {
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
  $('#cancel-comment-reply-link').on('click', function () {
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
  if (headers.length == 0) return;
  content = "<div id=\"toc\" class=\"toc\">\n\t<input type=\"checkbox\" role=\"button\" id=\"toctogglecheckbox\" class=\"toctogglecheckbox\" style=\"display:none\">\n\t<div class=\"toctitle\" lang=\"vi\" dir=\"ltr\"><h2>M\u1EE5c l\u1EE5c</h2><span class=\"toctogglespan\">\n\t<label class=\"toctogglelabel\" for=\"toctogglecheckbox\"></label></span></div><ul>";
  var previosNode = null;
  var index = [];
  var grade = 0;
  index[grade] = 1;

  for (var i = 0; i < headers.length; i++) {
    var header = $(headers[i]).first();
    var string = header.text(); // add id value to jump

    var slug = slugGenerate(string);
    header.attr('id', slug);
    var currentNode = header[0].localName; // first node

    if (!previosNode) {
      content += "<li><a href=\"#".concat(slug, "\"><span class=\"tocnumber\">").concat(getIndex(index, grade), "</span> <span class=\"toctext\">").concat(string, "</span></a>");
      previosNode = currentNode;
      continue;
    }

    if (currentNode == previosNode) {
      index[grade]++;
      content += "</li><li><a href=\"#".concat(slug, "\"><span class=\"tocnumber\">").concat(getIndex(index, grade), "</span> <span class=\"toctext\">").concat(string, "</span></a>");
      previosNode = currentNode;
      continue;
    }

    if (currentNode > previosNode) {
      index[++grade] = 1;
      content += "<ul><li><a href=\"#".concat(slug, "\"><span class=\"tocnumber\">").concat(getIndex(index, grade), "</span> <span class=\"toctext\">").concat(string, "</span></a>");
      previosNode = currentNode;
      continue;
    }

    if (currentNode < previosNode) {
      delete index[grade];
      grade--;
      index[grade]++;
      content += "</ul></li><li><a href=\"#".concat(slug, "\"><span class=\"tocnumber\">").concat(getIndex(index, grade), "</span> <span class=\"toctext\">").concat(string, "</span></a>");
      previosNode = currentNode;
      continue;
    }
  }

  content += '</li></ul></div>';
  $(content).insertAfter(insertAfter);
}

function slugGenerate(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim

  str = str.toLowerCase(); // remove accents, swap ñ for n, etc

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

  for (var i = 0; i <= grade; i++) {
    result += index[i] + '.';
  }

  return result.slice(0, -1);
}

/***/ }),

/***/ 10:
/*!*********************************************!*\
  !*** multi ./resources/assets/post/post.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Project\blog\resources\assets\post\post.js */"./resources/assets/post/post.js");


/***/ })

/******/ });