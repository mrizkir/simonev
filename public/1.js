(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    'vue-autonumeric': __webpack_require__(/*! vue-autonumeric */ "./node_modules/vue-autonumeric/dist/vue-autonumeric.min.js")
  },
  mounted: function mounted() {
    this.myValue = 100;
    this.populateData();
  },
  data: function data() {
    return {
      myValue: '',
      datadashboard: {
        'jumlah_opd': 0,
        'jumlah_kegiatan': 0,
        'jumlah_program': 0
      }
    };
  },
  methods: {
    populateData: function populateData() {
      var _this = this;

      axios.get('/api/datadashboard').then(function (response) {
        return _this.datadashboard = response.data;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "content-wrapper" },
    [
      _c("div", { staticClass: "content-header" }, [
        _c("div", { staticClass: "container-fluid" }, [
          _c("div", { staticClass: "row mb-2" }, [
            _vm._m(0),
            _vm._v(" "),
            _c("div", { staticClass: "col-sm-6" }, [
              _c("ol", { staticClass: "breadcrumb float-sm-right" }, [
                _c(
                  "li",
                  { staticClass: "breadcrumb-item" },
                  [_c("router-link", { attrs: { to: "/" } }, [_vm._v("HOME")])],
                  1
                ),
                _vm._v(" "),
                _c("li", { staticClass: "breadcrumb-item active" }, [
                  _vm._v("DASHBOARD")
                ])
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("section", { staticClass: "content" }, [
        _c("div", { staticClass: "container-fluid" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-12 col-sm-6 col-md-3" }, [
              _c("div", { staticClass: "info-box mb-3" }, [
                _vm._m(1),
                _vm._v(" "),
                _c("div", { staticClass: "info-box-content" }, [
                  _c("span", { staticClass: "info-box-text" }, [
                    _vm._v("JUMLAH OPD")
                  ]),
                  _vm._v(" "),
                  _c("span", { staticClass: "info-box-number" }, [
                    _vm._v(
                      "\r\n                                " +
                        _vm._s(_vm.datadashboard.jumlah_opd) +
                        "\r\n                            "
                    )
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-12 col-sm-6 col-md-3" }, [
              _c("div", { staticClass: "info-box" }, [
                _vm._m(2),
                _vm._v(" "),
                _c("div", { staticClass: "info-box-content" }, [
                  _c("span", { staticClass: "info-box-text" }, [
                    _vm._v("JUMLAH KEGIATAN")
                  ]),
                  _vm._v(" "),
                  _c("span", { staticClass: "info-box-number" }, [
                    _vm._v(
                      "\r\n                                " +
                        _vm._s(_vm.datadashboard.jumlah_kegiatan) +
                        "\r\n                            "
                    )
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "clearfix hidden-md-up" }),
            _vm._v(" "),
            _c("div", { staticClass: "col-12 col-sm-6 col-md-3" }, [
              _c("div", { staticClass: "info-box mb-3" }, [
                _vm._m(3),
                _vm._v(" "),
                _c("div", { staticClass: "info-box-content" }, [
                  _c("span", { staticClass: "info-box-text" }, [
                    _vm._v("JUMLAH PROGRAM")
                  ]),
                  _vm._v(" "),
                  _c("span", { staticClass: "info-box-number" }, [
                    _vm._v(_vm._s(_vm.datadashboard.jumlah_program))
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-12 col-sm-6 col-md-3" }, [
              _c("div", { staticClass: "info-box mb-3" }, [
                _vm._m(4),
                _vm._v(" "),
                _c("div", { staticClass: "info-box-content" }, [
                  _c("span", { staticClass: "info-box-text" }, [
                    _vm._v("PAGU DANA")
                  ]),
                  _vm._v(" "),
                  _c("span", { staticClass: "info-box-number" }, [
                    _vm._v(_vm._s(_vm.datadashboard.pagudana))
                  ])
                ])
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("vue-autonumeric", {
        attrs: { options: "euro", tag: "span" },
        model: {
          value: _vm.myValue,
          callback: function($$v) {
            _vm.myValue = $$v
          },
          expression: "myValue"
        }
      })
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-6" }, [
      _c("h1", { staticClass: "m-0 text-dark" }, [_vm._v("DASHBOARD")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "info-box-icon bg-danger elevation-1" }, [
      _c("i", { staticClass: "fas fa-thumbs-up" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "info-box-icon bg-info elevation-1" }, [
      _c("i", { staticClass: "fas fa-cog" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "info-box-icon bg-success elevation-1" }, [
      _c("i", { staticClass: "fas fa-shopping-cart" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "info-box-icon bg-warning elevation-1" }, [
      _c("i", { staticClass: "fas fa-users" })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/DashboardFront.vue":
/*!***********************************************!*\
  !*** ./resources/js/pages/DashboardFront.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DashboardFront.vue?vue&type=template&id=6bd60f3e& */ "./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e&");
/* harmony import */ var _DashboardFront_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DashboardFront.vue?vue&type=script&lang=js& */ "./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _DashboardFront_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/DashboardFront.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardFront_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardFront.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/DashboardFront.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardFront_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e&":
/*!******************************************************************************!*\
  !*** ./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardFront.vue?vue&type=template&id=6bd60f3e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/DashboardFront.vue?vue&type=template&id=6bd60f3e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardFront_vue_vue_type_template_id_6bd60f3e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);