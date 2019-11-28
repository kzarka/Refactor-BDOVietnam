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
$(document).ready(function () {
  validator = $('form.validate').validate();
  CKEDITOR.replace('content');
  $('select[name=game]').select2({
    theme: 'bootstrap'
  });
  $('select[name=category]').select2({
    theme: 'bootstrap'
  });
  $('button.save').on('click', function (e) {
    e.preventDefault();
    callAjaxSave();
  });
  initSlug();
  initToggleState();
  setTimeout(autoSave, 60000); // Start auto save after 1 minute
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

function callAjaxSave() {
  validator.form();
  console.log(validator.valid());
  if (!validator.valid()) return;
  return;
  $.ajax({
    url: $('form.validate').attr('action'),
    type: $('form.validate').attr('method'),
    data: $("form.validate").serializeArray(),
    success: function success(response) {
      if (response.status === 'SUCCESS') {
        notifySuccess('Saved!');
      } else if (response.status === 'ERROR') {
        notifyError(response.message);
      }
    },
    error: function error(xhr, status, _error) {
      var response = JSON.parse(xhr.responseText);

      if (response.errors) {
        notifyError('Some fields is not valid');
        parseFormError(response.errors);
      } else {
        $notifyError('System error.');
      }
    }
  });
}

function autoSave() {
  setInterval(callAjaxSave, 30000); // auto save every 5 minutes
}

/***/ }),

/***/ 5:
/*!***************************************************!*\
  !*** multi ./resources/assets/admin/post/edit.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Project\Refactor-BDOVietnam\resources\assets\admin\post\edit.js */"./resources/assets/admin/post/edit.js");


/***/ })

/******/ });