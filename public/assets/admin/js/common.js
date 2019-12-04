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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/admin/common.js":
/*!******************************************!*\
  !*** ./resources/assets/admin/common.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.slugGenerate = function (str) {
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
};

window.parseFormError = function (errors) {
  for (parameter in errors) {
    $('[name=' + parameter + ']').addClass('is-invalid');
    $('#' + parameter + '-error').html(errors[parameter]);
  }
};

window.getUrlParameter = function () {
  var parameters = window.location.search.substring(1);
  if (parameters) return '?' + parameters;
  return parameters;
};

$(document).ready(function () {
  var notify = $('input.notify').val();
  var type = $('input.notify').data('type');
  window.notify(null, notify, type);
  loadNotification(1);
});

window.notify = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var notify = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var type = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
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
  };

  if (notify) {
    switch (type) {
      case 'success':
        toastr.success(notify, title || 'Success');
        break;

      case 'error':
        toastr.error(notify, title || 'Error');
        break;

      default:
    }
  }
};

window.notifySuccess = function () {
  var content = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'Success';
  window.notify(title, content, 'success');
};

window.notifyError = function () {
  var content = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'Error';
  window.notify(title, content, 'error');
};

function loadNotification(page) {
  $.ajax({
    url: NOTIFICATION_URL + '?page=' + page,
    type: 'GET',
    success: function success(response) {
      if (response.status === 'SUCCESS') {
        parseNotification(response.data);
      } else if (response.status === 'ERROR') {
        console.log('error');
      }
    },
    error: function error(xhr, status, _error) {}
  });
}

function parseNotification(data) {
  var insertBefore = $('.dropdown-menu.notification').find('.dropdown-item.load-more');
  var rows = $('.dropdown-menu.notification').find('.dropdown-item.item');
  var row = rows.first().clone();

  for (var i = 0; i < data.length; i++) {
    if (rows.length == 1) {
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
  $('.dropdown-menu.notification').on('click', '.dropdown-item.load-more', function () {});
}

/***/ }),

/***/ 9:
/*!************************************************!*\
  !*** multi ./resources/assets/admin/common.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Project\Refactor-BDOVietnam\resources\assets\admin\common.js */"./resources/assets/admin/common.js");


/***/ })

/******/ });