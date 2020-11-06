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

/***/ "./resources/js/admin.js":
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.pAjax = function (url) {
  var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var successCallback = arguments.length > 2 ? arguments[2] : undefined;
  var errorCallback = arguments.length > 3 ? arguments[3] : undefined;
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'post',
    url: url,
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function success(res) {
      if (!$.isEmptyObject(res.errors)) {
        for (var key in res.errors) {
          console.log(key);
          console.log(res.errors[key]);
          itoastr('error', res.errors[key]);
          $("[name=\"".concat(key, "\"]")).invalid();
        }
      }

      successCallback(res);
    },
    error: function error(err) {
      console.log(err);
      itoastr('error', 'Something went wrong');

      if (errorCallback) {
        errorCallback(err);
      }
    }
  });
};

$.fn.extend({
  loading: function loading() {
    var _loading = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    var html = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

    if (_loading) {
      this.html("<i class='fa fa-spinner fa-spin fa-2x fa-fw'></i>").attr("disabled", true);
    } else {
      this.html(html || "Submit").attr("disabled", false);
    }
  },
  invalid: function invalid() {
    var _invalid = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    if (_invalid && !this.hasClass('is-invalid')) {
      this.addClass('is-invalid');
    }

    if (!_invalid && this.hasClass('is-invalid')) {
      this.removeClass('is-invalid');
    }
  },
  disable: function disable() {
    var disabled = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    if (disabled && !this.hasClass('disabled')) {
      this.addClass('disabled');
    }

    if (!disabled && this.hasClass('disabled')) {
      this.removeClass('disabled');
    }
  },
  hide: function hide() {
    if (!this.hasClass('d-none')) this.addClass('d-none');
  },
  show: function show() {
    if (this.hasClass('d-none')) this.removeClass('d-none');
  },
  check: function check() {
    var checked = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    this.prop('checked', checked);
  },
  formData: function formData() {
    var formData = new FormData();
    var inputs = this.find('input');
    var selects = this.find('select');
    var textAreas = this.find('textarea');
    var forms = [];
    inputs.each(function (index, item) {
      $(item).attr('name') && forms.push($(item));
    });
    selects.each(function (index, item) {
      $(item).attr('name') && forms.push($(item));
    });
    textAreas.each(function (index, item) {
      $(item).attr('name') && forms.push($(item));
    });

    for (var _i = 0, _forms = forms; _i < _forms.length; _i++) {
      var formItem = _forms[_i];
      formData.append(formItem.attr('name'), formItem.val());
    }

    return formData;
  },
  clear: function clear() {
    this.find('input').val('');
    this.find('input').removeClass('is-invalid');
  },
  crud: function crud(options) {
    var csvImport = options && options.csvImport || false;
    var dataTable = options && options.dataTable || true;
    var dataTableOption = options && options.dataTableOption || {};
    var markIndex = options && options.markIndex || true;
    var addable = options && options.addable || true;
    var editable = options && options.editable || true;
    var deletable = options && options.deletable || true;
    var deleteUrl = options && options.urls["delete"] || '';
    var editUrl = options && options.urls.edit || '';
    var updateUrl = options && options.urls.update || '';
    var indexColumnNumber = options && options.indexColumnNumber || 0;
    var apiProcessing = false;
    var updating = false;
    var that = this;
    var ids;
    var rows;
    var table;
    var idsForUpdate;
    var rowsForUpdate;

    function init() {
      ids = [];
      rows = [];
      idsForUpdate = [];
      rowsForUpdate = [];
      that.find('.delete-all').disable();
      that.find('.edit-all').disable();
      that.find('.save-all').disable();
      that.find('.select-all').check(false);
      dataTable && table && table.fnDraw();
    }

    csvImport && that.find('.csv-import').click(function () {
      that.find('.csv-file-picker').click();
      that.find('.csv-file-picker').change(function () {
        var submitUrl = $(this).data('submit-url');
        var formData = new FormData();
        formData.append('csv-file', $(this).val());
        pAjax(submitUrl, formData, function (res) {
          console.log(res);
        });
      });
    });
    addable && that.find('.add-new').click(function () {
      that.find('.add-form-container').show();
      that.find('.dataTables_wrapper').hide();
      that.find('.add-new').hide();
      that.find('.edit-all').hide();
      that.find('.delete-all').hide();
      that.find('.save-all').hide();

      if (csvImport) {
        that.find('.csv-import').show();
        that.find('.btn-cancel-add').show();
      }
    });
    addable && that.find('.btn-cancel-add').click(function (e) {
      e.preventDefault();
      that.find('.add-form-container').hide();
      that.find('.add-new').show();
      that.find('.edit-all').show();
      that.find('.delete-all').show();
      that.find('.save-all').show();
      that.find('.dataTables_wrapper').show();

      if (csvImport) {
        that.find('.csv-import').hide();
        that.find('.btn-cancel-add').hide();
      }
    });
    addable && that.find('.add-form').find('input').change(function () {
      that.find('.create-item').loading(false);
      $(this).invalid(false);
    });
    addable && that.find('.add-form').submit(function (e) {
      e.preventDefault();
      that.find('.create-item').loading();
      var formData = new FormData(this);
      var form = $(this);
      pAjax($(this).attr('action'), formData, function (res) {
        apiProcessing = true;

        if (res.status) {
          itoastr('success', 'Created successfully');
          that.find('.create-item').loading(false);

          if (dataTable) {
            table.fnAddData(res.data);
          } else {
            that.find('tbody').append(res.view);
          }

          form.clear();
        }

        apiProcessing = false;
        init();
      });
    });
    that.find('.select-all').click(function () {
      that.find('.select-item:enabled').prop('checked', $(this).prop('checked'));
      checkSelectedItems();
    });
    $(document).on('change', '.select-item', function () {
      checkSelectedItems();
    });
    $(document).on('click', '.delete-item', function () {
      ids = [$(this).data('id')];
      rows = [$(this).parents('tr')];
    });
    $(document).on('click', '.delete-all, .delete-item', function () {
      if (!$(this).hasClass('disabled')) {
        $('#delete-confirm-modal').modal('show');
      }
    });
    editable && $(document).on('click', '.edit-all', function () {
      if (!$(this).hasClass('disabled')) {
        renderEditRow();
      }
    });
    editable && $(document).on('click', '.edit-item', function () {
      if (!$(this).hasClass('disabled')) {
        ids = [$(this).data('id')];
        rows = [$(this).parents('tr')];
        renderEditRow();
      }
    });
    $(document).on('click', '.save-all', function () {
      if (!$(this).hasClass('disabled')) {
        checkSelectedItems();
        submitForUpdate();
      }
    });
    $(document).on('click', '.update-item', function () {
      if (!$(this).hasClass('disabled')) {
        idsForUpdate = [$(this).data('id')];
        rowsForUpdate = [$(this).parents('tr')];
        submitForUpdate();
      }
    });
    $('.delete-confirm-btn').click(function () {
      var formData = new FormData();
      formData.append('ids', ids.join(','));
      pAjax(deleteUrl, formData, function (res) {
        if (res.status) {
          var _iterator = _createForOfIteratorHelper(rows),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var row = _step.value;

              if (dataTable) {
                table.fnDeleteRow(row.data(row));
              } else {
                row.remove();
              }
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }

          $('#delete-confirm-modal').modal('hide');
          init();
          itoastr('success', 'Deleted Successfully!');
        }
      });
    });

    function checkSelectedItems() {
      var disabled = true;
      var saveAllButtonDisabled = true;
      ids = [];
      rows = [];
      idsForUpdate = [];
      rowsForUpdate = [];
      that.find('.select-item').each(function (index, item) {
        if ($(item).prop('checked') && !$(item).prop('disabled')) {
          disabled = false;
          $(item).parents('tr').find('.edit-item').disable();
          $(item).parents('tr').find('.delete-item').disable();
          ids.push($(item).data('id'));
          rows.push($(item).parents('tr'));
        } else {
          $(item).parents('tr').find('.edit-item').disable(false);
          $(item).parents('tr').find('.delete-item').disable(false);
        }

        if ($(item).parents('tr').find('.update-item').length === 1) {
          saveAllButtonDisabled = false;
          idsForUpdate.push($(item).data('id'));
          rowsForUpdate.push($(item).parents('tr'));
        }
      });
      that.find('.delete-all').disable(disabled);
      that.find('.edit-all').disable(disabled);
      that.find('.save-all').disable(saveAllButtonDisabled);
    }

    function markIndexNumbers() {
      that.find('tbody').find('tr').each(function (index, item) {
        updating = true;
        $($(item).find('td')[indexColumnNumber]).text(index + 1);
      });
    }

    function renderEditRow() {
      if (editable) {
        var formData = new FormData();
        formData.append('ids', ids.join(','));
        pAjax(editUrl, formData, function (res) {
          if (res.status) {
            apiProcessing = true;

            var _loop = function _loop(i) {
              var row = rows[i];

              if (dataTable) {
                var oldData = table.fnGetData(table.fnGetPosition(row[0]));
                table.fnUpdate(res.data[i], table.fnGetPosition(row[0]));
                row.find('.cancel-item').click(function () {
                  table.fnUpdate(oldData, table.fnGetPosition(row[0]));
                });
              } else {
                var oldHtml = row.html();
                row.html(res.view[i]);
                row.find('.cancel-item').click(function () {
                  row.html(oldHtml);
                });
              }
            };

            for (var i in rows) {
              _loop(i);
            }

            apiProcessing = false;
            init();
          }
        });
      }
    }

    function dataTableUpdate() {
      if (!updating && !apiProcessing) {
        markIndex && markIndexNumbers();
        checkSelectedItems();
      }

      updating = false;
    }

    function submitForUpdate() {
      var formData = new FormData();

      for (var i in idsForUpdate) {
        var _getFormData = getFormData(rowsForUpdate[i]),
            jsonData = _getFormData.jsonData;

        formData.append('id[]', idsForUpdate[i]);

        for (var key in jsonData) {
          formData.append("".concat(key, "[]"), jsonData[key]);
        }
      }

      pAjax(updateUrl, formData, function (res) {
        apiProcessing = true;

        if (res.status) {
          for (var _i2 in rowsForUpdate) {
            var row = rowsForUpdate[_i2];

            if (dataTable) {
              table.fnUpdate(res.data[_i2], table.fnGetPosition(row[0]));
            } else {
              row.before(res.view[_i2]);
              row.remove();
            }
          }
        }

        apiProcessing = false;
        init();
      });
    }

    if (dataTable) {
      table = dataTable && that.find('table').dataTable({
        order: [],
        columnDefs: [{
          targets: 'no-sort',
          orderable: false
        }, {
          targets: 'no-search',
          searchable: false
        }],
        drawCallback: function drawCallback() {
          dataTableUpdate();
        }
      });
    }

    init();
  }
});

function getFormData(formContainer) {
  var formData = new FormData();
  var jsonData = {};
  var inputs = formContainer.find('input');
  var selects = formContainer.find('select');
  var textAreas = formContainer.find('textarea');
  var forms = [];
  inputs.each(function (index, item) {
    $(item).attr('name') && forms.push($(item));
  });
  selects.each(function (index, item) {
    $(item).attr('name') && forms.push($(item));
  });
  textAreas.each(function (index, item) {
    $(item).attr('name') && forms.push($(item));
  });

  for (var _i3 = 0, _forms2 = forms; _i3 < _forms2.length; _i3++) {
    var formItem = _forms2[_i3];
    formData.append(formItem.attr('name'), formItem.val());
    jsonData[formItem.attr('name')] = formItem.val();
  }

  return {
    formData: formData,
    jsonData: jsonData
  };
}

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/admin.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\Working\Laravel\2020-11-04\resources\js\admin.js */"./resources/js/admin.js");


/***/ })

/******/ });