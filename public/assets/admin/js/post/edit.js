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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/admin/post/edit.js":
/*!*********************************************!*\
  !*** ./resources/assets/admin/post/edit.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var validator = null;
var form = null;
var lastInputTime = new Date();
var TIME_TILL_SAVE = 300000; // 5min

var TIME_RE_CHECK = 10000; // 10s

var intervalSave = null;
$(document).ready(function () {
  initFormSave();
  CKEDITOR.replace('content');
  $('select[name=game]').select2({
    theme: 'bootstrap'
  });
  $('select[name="category[]"]').select2({
    theme: 'bootstrap'
  }).val(selected_categories).trigger('change');
  $('button.save').on('click', function (e) {
    e.preventDefault();
    $('form.validate').submit();
  });
  $('button.preview').on('click', function (e) {
    e.preventDefault();
    $('form.preview').find('[name=content]').val(CKEDITOR.instances.content.getData());
    $('form.preview').find('[name=title]').val($('form.validate').find('[name=title]').val());
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
  $("input[name=tags]").tagsinput({
    splitOn: ',',
    cancelConfirmKeysOnEmpty: false
  });
  $('[data-toggle="tooltip"]').tooltip();
  initSlug();
  initToggleState();
  initAutoSave();
  initSelectImage();
  initSelectFormCategory();
});

function initSlug() {
  $('form.validate').on('keyup', 'input[name=title]', function () {
    $('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
  });
}

function initToggleState() {
  $('form.validate input.public').on('click', function () {
    if ($(this).prop('checked')) {
      $(this).val(1);
    } else {
      $(this).val(0);
    }
  });
}

function triggerSave() {
  $('form.validate').submit();
}

function initFormSave() {
  form = $('form.validate').validate({
    submitHandler: function submitHandler(form, event) {
      event.preventDefault();
      var formData = new FormData(form);
      formData.append('content', CKEDITOR.instances.content.getData());
      $.ajax({
        url: $(form).attr('action'),
        type: $(form).attr('method'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: beforeSaving,
        success: function success(response) {
          if (response.status === 'SUCCESS') {
            notifySuccess('Saved!');
          } else if (response.status === 'ERROR') {
            notifyError(response.message);
          }

          afterSaving();
        },
        error: function error(xhr, status, _error) {
          var response = JSON.parse(xhr.responseText);

          if (response.errors) {
            notifyError('Some fields is not valid');
            parseFormError(response.errors);
          } else {
            notifyError('System error.');
          }

          afterSaving();
        }
      });
      return false;
    }
  });
}

function setAutoSave() {
  // from last input till next 5min, save
  intervalSave = setInterval(function () {
    var current = new Date();
    console.log('Recheck');
    var diff = Math.abs(current - lastInputTime);

    if (diff >= TIME_TILL_SAVE) {
      triggerSave();
      clearInterval(intervalSave);
    }
  }, TIME_RE_CHECK); // check save every 10s
}

function initAutoSave() {
  $('div.card').on('click', function () {
    autoSave();
  });
  CKEDITOR.instances['content'].on('contentDom', function () {
    this.document.on('click', function (event) {
      autoSave();
    });
  });
}

function autoSave() {
  lastInputTime = new Date();

  if (intervalSave) {
    clearInterval(intervalSave);
  }

  setAutoSave();
}

function initSelectImage() {
  $('.add-image').on('click', function () {
    $('input[name=images]').trigger('click');
  });
  $('input[name=images]').change(function () {
    readURL(this);
  });
  $('.close-icon').on('click', function () {
    $('#p_remove_image').modal('show');
  });
  $('#confirm_remove').on('click', function () {
    $('input[name=images]').val('');
    $('.cover-image-button.images').addClass('hidden');
  });
  $('.photo-frame').on('click', function () {
    $('#p_preview_image').find('img').attr('src', $(this).find('img').attr('src'));
    $('#p_preview_image').modal('show');
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('.cover-image-button.images').removeClass('hidden');
      $('.cover-image-button.images').find('img').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function initSelectFormCategory() {
  $('#parent_category').on('change', function () {
    var parentId = $(this).val();

    if (parentId == '' || parentId == null) {
      $('#category').prop('disabled', true).html('');
      return;
    }

    loadChildCategories(parentId);
  });
  initSelectedCategory();
}

function loadChildCategories(parentId) {
  var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  if (parentId <= 0) return;
  var children = child_categories[parentId - 1];
  $('#category').prop('disabled', false).html('');
  var index = children.length;
  $.each(children, function (value, id) {
    var row = '<option value="' + id + '">' + value + '</option>';
    $('#category').append(row);
  });

  if (callback) {
    callback();
  }
}

function initSelectedCategory() {
  var parentId = $('#parent_category').val();
  loadChildCategories(parentId, function () {
    $('#category').val(selected_categories).trigger('change');
  });
}

function beforeSaving() {
  $('button.save').prop('disabled', true);
  $('button.save').html('<i class="fa fa-spinner fa-spin"></i> Lưu');
}

function afterSaving() {
  $('button.save').prop('disabled', false);
  $('button.save').html('Lưu');
}

/***/ }),

/***/ 5:
/*!***************************************************!*\
  !*** multi ./resources/assets/admin/post/edit.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Project\blog\resources\assets\admin\post\edit.js */"./resources/assets/admin/post/edit.js");


/***/ })

/******/ });