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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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
      console.log(res);

      if (!$.isEmptyObject(res.errors)) {
        for (var key in res.errors) {
          itoastr('error', res.errors[key]);
          var name = key.split('.')[0];
          var order = key.split('.')[1];

          if (order) {
            $($("[name=\"".concat(name, "[]\"]"))[order]).invalid();
          } else {
            $("[name=\"".concat(key, "\"]")).invalid();
          }
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

window.fLog = function (formData) {
  var data = {};
  formData.forEach(function (value, key) {
    data[key] = value;
  });
  console.log(data);
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
    var jsonData = {};
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
      jsonData[formItem.attr('name')] = formItem.val();
    }

    return {
      formData: formData,
      jsonData: jsonData
    };
  },
  clear: function clear() {
    this.find('input').val('');
    this.find('input').removeClass('is-invalid');
  },
  crud: function crud(options) {
    var crud = new CRUD(_objectSpread({
      container: this
    }, options));
    crud.initialize();
    return crud;
  }
});

var CRUD = /*#__PURE__*/function () {
  function CRUD(options) {
    _classCallCheck(this, CRUD);

    Object.assign(this, {
      csvImport: false,
      dataTable: true,
      dataTableOption: {},
      markIndex: true,
      addable: true,
      addFormSubmit: null,
      multiSubmitForAdd: false,
      editable: true,
      deletable: true,
      deleteUrl: null,
      editUrl: null,
      updateUrl: null,
      indexColumnNumber: 0,
      apiProcessing: false,
      updating: false,
      showTableWithAddForm: false,
      tableFetchUrl: null,
      container: null,
      fnEdit: null,
      ids: [],
      rows: [],
      table: null,
      idsForUpdate: [],
      rowsForUpdate: [],
      fnFilter: null
    }, options);
  }

  _createClass(CRUD, [{
    key: "init",
    value: function init() {
      var _this = this;

      this.ids = [];
      this.rows = [];
      this.idsForUpdate = [];
      this.rowsForUpdate = [];
      this.container.find('.delete-all').disable();
      this.container.find('.edit-all').disable();
      this.container.find('.save-all').disable();
      this.container.find('.select-all').check(false);
      var $this = this;

      if (this.tableFetchUrl) {
        // Fetch table data
        this.container.find('tbody').append("<tr><td class=\"text-center\" colspan=\"".concat(this.container.find('thead>tr:last th').length, "\"><i class=\"fa fa-spinner fa-spin fa-2x fa-fw text-info\" style=\"font-size: 70px\"></i></td></tr>"));
        $.ajax({
          type: 'get',
          url: $this.tableFetchUrl,
          success: function success(res) {
            if (res.status) {
              if (res.view !== "") {
                $this.container.find('tbody').html(res.view);
              } else {
                $this.container.find('tbody').html("<tr><td class=\"text-center\" colspan=\"".concat(_this.container.find('thead>tr:last th').length, "\">There is no available data</td></tr>"));
              }

              $this.markIndexNumbers();
            }
          },
          error: function error(err) {
            return console.log(err);
          }
        });
      }
    }
  }, {
    key: "initialize",
    value: function initialize() {
      var $this = this;
      this.csvImport && this.container.find('.csv-import').click(function () {
        $this.container.find('.csv-file-picker').click();
        $this.container.find('.csv-file-picker').change(function () {
          var submitUrl = $(this).data('submit-url');
          var formData = new FormData();
          formData.append('csv-file', this.files[0]);
          var modal = $('#submit-csv-file-dialog');
          modal.modal('show');
          modal.on("hide.bs.modal", function () {
            $this.container.find('.csv-file-picker').val('');
          });
          $('.csv-submit-btn').click(function () {
            var _modal$formData = modal.formData(),
                formData = _modal$formData.formData;

            var btn = $(this);
            btn.loading();
            formData.append('csv-file', $this.container.find('.csv-file-picker')[0].files[0]);
            fLog(formData);
            pAjax(submitUrl, formData, function (res) {
              if (res.status) {
                window.location.reload();
              }

              btn.loading(false);
            });
          });
        });
      });
      this.addable && this.container.find('.add-new').click(function () {
        $this.container.find('.add-form-container').show();

        if (!$this.showTableWithAddForm) {
          $this.container.find('.dataTables_wrapper').hide();
          $this.container.find('.add-new').hide();
          $this.container.find('.edit-all').hide();
          $this.container.find('.delete-all').hide();
          $this.container.find('.save-all').hide();
        }

        if ($this.csvImport) {
          $this.container.find('.btn-cancel-add').show();
        }
      });
      $this.addable && $this.container.find('.btn-cancel-add').click(function (e) {
        e.preventDefault();
        $this.container.find('.add-form-container').hide();
        $this.container.find('.add-new').show();
        $this.container.find('.edit-all').show();
        $this.container.find('.delete-all').show();
        $this.container.find('.save-all').show();
        $this.container.find('.dataTables_wrapper').show();

        if ($this.csvImport) {
          $this.container.find('.btn-cancel-add').hide();
        }
      }); //make invalid fields valid when it's value is changed.

      $this.addable && $this.container.on('change keyup', 'input', function () {
        $this.container.find('.create-item').loading(false);
        $(this).invalid(false);
      });
      $this.container.on('click', '.data-table-filter', function () {
        $this.fnFilter($this, $this.table);
      }); // add form submit

      $this.addable && $this.container.find('.add-form').submit(function (e) {
        e.preventDefault();

        if ($this.addFormSubmit) {
          $this.addFormSubmit($this.table, this);
        } else {
          $this.container.find('.create-item').loading();
          var formData = new FormData(this);
          var form = $(this);
          $this.container.find('input').attr('disabled', true);
          $this.container.find('select').attr('disabled', true);
          $this.container.find('textarea').attr('disabled', true);
          pAjax($(this).attr('action'), formData, function (res) {
            $this.apiProcessing = true;

            if (res.status) {
              $this.container.find('.create-item').loading(false);

              if ($this.multiSubmitForAdd) {
                console.log('add form response', res);
              } else {
                if ($this.dataTable) {
                  $this.table.fnAddData(res.data);
                } else {
                  $this.container.find('tbody').append(res.view);
                }
              }

              if (res.message) {
                itoastr('success', res.message);
              } else {
                itoastr('success', 'Created successfully');
              }

              form.clear();
            }

            $this.container.find('input').attr('disabled', false);
            $this.container.find('select').attr('disabled', false);
            $this.container.find('textarea').attr('disabled', false);
            $this.apiProcessing = false;
            $this.container.find('.create-item').loading(false);
            $this.init();
          });
        }
      });
      this.container.find('.select-all').click(function () {
        $this.container.find('.select-item:enabled').prop('checked', $(this).prop('checked'));
        $this.checkSelectedItems();
      });
      $(this.container).on('change', '.select-item', function () {
        $this.checkSelectedItems();
      });
      $(this.container).on('click', '.delete-item', function () {
        $this.ids = [$(this).data('id')];
        $this.rows = [$(this).parents('tr')];
      });
      $(this.container).on('click', '.delete-all, .delete-item', function () {
        if (!$(this).hasClass('disabled')) {
          $('#delete-confirm-modal').modal('show');
        }
      });
      $this.editable && $(document).on('click', '.edit-all', function () {
        if (!$(this).hasClass('disabled')) {
          $this.renderEditRow();
        }
      });
      $this.editable && $($this.container).on('click', '.edit-item', function () {
        if ($this.fnEdit) {
          $this.fnEdit($this, this);
        } else {
          if (!$(this).hasClass('disabled')) {
            $this.ids = [$(this).data('id')];
            $this.rows = [$(this).parents('tr')];
            $this.renderEditRow();
          }
        }
      });
      $($this.container).on('click', '.save-all', function () {
        if (!$(this).hasClass('disabled')) {
          $this.checkSelectedItems();
          $this.submitForUpdate();
        }
      });
      $($this.container).on('click', '.update-item', function () {
        if (!$(this).hasClass('disabled')) {
          $this.idsForUpdate = [$(this).data('id')];
          $this.rowsForUpdate = [$(this).parents('tr')];
          $this.submitForUpdate();
        }
      }); // submit delete

      $('.delete-confirm-btn').click(function () {
        var formData = new FormData();
        formData.append('ids', $this.ids.join(','));
        $('.delete-confirm-btn').loading();
        pAjax($this.deleteUrl, formData, function (res) {
          if (res.status) {
            var _iterator = _createForOfIteratorHelper($this.rows),
                _step;

            try {
              for (_iterator.s(); !(_step = _iterator.n()).done;) {
                var row = _step.value;

                if ($this.dataTable) {
                  $this.table.fnDeleteRow(row.data(row));
                } else {
                  row.remove();
                }
              }
            } catch (err) {
              _iterator.e(err);
            } finally {
              _iterator.f();
            }

            $('.delete-confirm-btn').loading(false);
            $('#delete-confirm-modal').modal('hide');
            $this.init();

            if (res.message) {
              itoastr('success', res.message);
            } else {
              itoastr('success', 'Deleted Successfully!');
            }
          }
        });
      });
      console.log($this.dataTable);

      if ($this.dataTable) {
        $this.table = $this.dataTable && $this.container.find('table').dataTable({
          order: [],
          columnDefs: [{
            targets: 'no-sort',
            orderable: false
          }, {
            targets: 'no-search',
            searchable: false
          }],
          drawCallback: function drawCallback() {
            $this.dataTableUpdate();
          }
        });
      }

      $this.init();
    }
  }, {
    key: "checkSelectedItems",
    value: function checkSelectedItems() {
      var disabled = true;
      var saveAllButtonDisabled = true;
      this.ids = [];
      this.rows = [];
      this.idsForUpdate = [];
      this.rowsForUpdate = [];
      var $this = this;
      this.container.find('.select-item').each(function (index, item) {
        if ($(item).prop('checked') && !$(item).prop('disabled')) {
          disabled = false;
          $(item).parents('tr').find('.edit-item').disable();
          $(item).parents('tr').find('.delete-item').disable();
          $this.ids.push($(item).data('id'));
          $this.rows.push($(item).parents('tr'));
        } else {
          $(item).parents('tr').find('.edit-item').disable(false);
          $(item).parents('tr').find('.delete-item').disable(false);
        }

        if ($(item).parents('tr').find('.update-item').length === 1) {
          saveAllButtonDisabled = false;
          $this.idsForUpdate.push($(item).data('id'));
          $this.rowsForUpdate.push($(item).parents('tr'));
        }
      });
      this.container.find('.delete-all').disable(disabled);
      this.container.find('.edit-all').disable(disabled);
      this.container.find('.save-all').disable(saveAllButtonDisabled);
    } // mark index numbers to table.

  }, {
    key: "markIndexNumbers",
    value: function markIndexNumbers() {
      var $this = this;
      this.container.find('tbody').find('tr').each(function (index, item) {
        $this.updating = true;

        if ($(item).find('td').length > 3) {
          $($(item).find('td')[$this.indexColumnNumber]).text(index + 1);
        }
      });
    }
  }, {
    key: "renderEditRow",
    value: function renderEditRow() {
      if (this.editable) {
        var formData = new FormData();
        formData.append('ids', this.ids.join(','));
        var $this = this;
        pAjax(this.editUrl, formData, function (res) {
          if (res.status) {
            $this.apiProcessing = true;

            var _loop = function _loop(i) {
              var row = $this.rows[i];

              if ($this.dataTable) {
                var oldData = $this.table.fnGetData($this.table.fnGetPosition(row[0]));
                $this.table.fnUpdate(res.data[i], $this.table.fnGetPosition(row[0]));
                row.find('.cancel-item').click(function () {
                  $this.table.fnUpdate(oldData, $this.table.fnGetPosition(row[0]));
                });
              } else {
                var oldHtml = row.html();
                row.html(res.view[i]);
                row.find('.cancel-item').click(function () {
                  row.html(oldHtml);
                });
              }
            };

            for (var i in $this.rows) {
              _loop(i);
            }

            $this.apiProcessing = false;
            $this.init();
          }
        });
      }
    }
  }, {
    key: "dataTableUpdate",
    value: function dataTableUpdate() {
      if (!this.updating && !this.apiProcessing) {
        this.markIndex && this.markIndexNumbers();
        this.checkSelectedItems();
      }

      this.updating = false;
    }
  }, {
    key: "submitForUpdate",
    value: function submitForUpdate() {
      var formData = new FormData();

      for (var i in this.idsForUpdate) {
        var _this$rowsForUpdate$i = this.rowsForUpdate[i].formData(),
            jsonData = _this$rowsForUpdate$i.jsonData;

        formData.append('id[]', this.idsForUpdate[i]);

        for (var key in jsonData) {
          formData.append("".concat(key, "[]"), jsonData[key]);
        }
      }

      var $this = this;
      pAjax(this.updateUrl, formData, function (res) {
        $this.apiProcessing = true;

        if (res.status) {
          for (var _i2 in $this.rowsForUpdate) {
            var row = $this.rowsForUpdate[_i2];

            if ($this.dataTable) {
              $this.table.fnUpdate(res.data[_i2], $this.table.fnGetPosition(row[0]));
            } else {
              row.before(res.view[_i2]);
              row.remove();
            }
          }
        }

        $this.apiProcessing = false;
        $this.init();
      });
    }
  }]);

  return CRUD;
}();

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