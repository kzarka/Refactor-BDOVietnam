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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/admin/games/game.js":
/*!**********************************************!*\
  !*** ./resources/assets/admin/games/game.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var form = null;
$(document).ready(function () {
  initEditModal();
  initDeleteModal();
  initCreateModal();
  initSaveForm();
  initSlug();
  $('#g_form').on('hidden.bs.modal', function () {
    form.resetForm();
    $(this).find('input').val('').removeClass("is-invalid");
    $(this).find('input').find('input[name=status]').prop('checked', true);
    $(this).find('div.form-group').removeClass("is-invalid");
  });
  $('button.submit').on('click', function (e) {
    e.preventDefault();
    $('form.validate').submit();
  });
});

function initEditModal() {
  $('button.edit').on('click', function () {
    var row = $(this).closest('tr');
    $('form.validate').attr('action', BASE_API + '/' + row.data('id')).attr('method', 'PUT');
    $('form.validate').find('input[name=name]').val(row.find('td.name').html());
    $('form.validate').find('input[name=thumbnail]').val(row.find('td.thumbnail').find('img').attr('src'));
    $('form.validate').find('input[name=slug]').val(row.find('td.slug').html());
    var active = row.find('td.active').find('span').data('active');
    $('form.validate').find('input[name=active]').prop('checked', !!active);
    $('#g_form').modal('show');
  });
}

function initDeleteModal() {
  $('button.delete').on('click', function () {
    $('#g_delete').modal('show');
  });
}

function initCreateModal() {
  $('button.create').on('click', function () {
    $('form.validate').attr('action', BASE_API).attr('method', 'POST');
    $('#g_form').modal('show');
  });
}

function initSaveForm() {
  form = $('form.validate').validate({
    submitHandler: function submitHandler(form) {
      var values = $("form.validate").serializeArray();
      values = values.concat($('form.validate input[type=checkbox]:not(:checked)').map(function () {
        return {
          "name": this.name,
          "value": 0
        };
      }).get()).concat($('form.validate input[type=checkbox]:checked').map(function () {
        return {
          "name": this.name,
          "value": 1
        };
      }).get());
      $.ajax({
        url: $(form).attr('action'),
        type: $(form).attr('method'),
        data: values,
        success: function success(response) {
          console.log('Success');

          if (response.success === true) {} else {}
        }
      });
      return false;
    }
  });
}

function initSlug() {
  $('form.validate').on('keyup', 'input[name=name]', function () {
    $('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
  });
}

/***/ }),

/***/ 1:
/*!****************************************************!*\
  !*** multi ./resources/assets/admin/games/game.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Project\blog\resources\assets\admin\games\game.js */"./resources/assets/admin/games/game.js");


/***/ })

/******/ });