(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/FormValidation.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/FormValidation.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__);
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
  data: function data() {
    return {
      //form
      Jumlah1: '',
      Jumlah2: '',
      submitStatus: null
    };
  },
  validations: {
    Jumlah1: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"]
    },
    Jumlah2: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"]
    }
  },
  methods: {
    saveData: function saveData() {
      var _this = this;

      this.$v.$touch();

      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR';
      } else {
        // do your submit logic here
        this.submitStatus = 'PENDING';
        setTimeout(function () {
          _this.submitStatus = 'OK';
        }, 500);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4& ***!
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
  return _c("div", { staticClass: "content-wrapper" }, [
    _c("section", { staticClass: "content-header" }, [
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
              _c("li", { staticClass: "breadcrumb-item" }, [_vm._v("MASTER")]),
              _vm._v(" "),
              _c("li", { staticClass: "breadcrumb-item active" }, [
                _vm._v("PAGU ANGGARAN OPD / SKPD")
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
          _c("div", { staticClass: "col-12" }, [
            _c("div", { staticClass: "card card-info" }, [
              _vm._m(1),
              _vm._v(" "),
              _c(
                "form",
                {
                  staticClass: "form-horizontal",
                  on: {
                    submit: function($event) {
                      $event.preventDefault()
                      return _vm.saveData($event)
                    }
                  }
                },
                [
                  _c("div", { staticClass: "card-body" }, [
                    _c("div", { staticClass: "form-group row" }, [
                      _c("label", { staticClass: "col-sm-3 col-form-label" }, [
                        _vm._v("PAGU ANGGARAN APBD")
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-sm-9" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model.trim",
                              value: _vm.$v.Jumlah1.$model,
                              expression: "$v.Jumlah1.$model",
                              modifiers: { trim: true }
                            }
                          ],
                          staticClass: "form-control",
                          class: { "is-invalid": _vm.$v.Jumlah1.$error },
                          domProps: { value: _vm.$v.Jumlah1.$model },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.$v.Jumlah1,
                                "$model",
                                $event.target.value.trim()
                              )
                            },
                            blur: function($event) {
                              return _vm.$forceUpdate()
                            }
                          }
                        }),
                        _vm._v(" "),
                        !_vm.$v.Jumlah1.required
                          ? _c("div", { staticClass: "form-error-message" }, [
                              _vm._v("* wajib isi")
                            ])
                          : _vm._e()
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c("label", { staticClass: "col-sm-3 col-form-label" }, [
                        _vm._v("PAGU ANGGARAN APBDP")
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-sm-9" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.Jumlah2,
                              expression: "Jumlah2"
                            }
                          ],
                          staticClass: "form-control",
                          class: { "is-invalid": _vm.$v.Jumlah1.$error },
                          attrs: {
                            type: "text",
                            name: "Jumlah2",
                            id: "Jumlah2"
                          },
                          domProps: { value: _vm.Jumlah2 },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.Jumlah2 = $event.target.value
                            }
                          }
                        }),
                        _vm._v(" "),
                        !_vm.$v.Jumlah2.required
                          ? _c("div", { staticClass: "form-error-message" }, [
                              _vm._v("* wajib isi")
                            ])
                          : _vm._e()
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass: "button",
                        attrs: {
                          type: "submit",
                          disabled: _vm.submitStatus === "PENDING"
                        }
                      },
                      [_vm._v("Submit!")]
                    ),
                    _vm._v(" "),
                    _vm.submitStatus === "OK"
                      ? _c("p", { staticClass: "typo__p" }, [
                          _vm._v("Thanks for your submission!")
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.submitStatus === "ERROR"
                      ? _c("p", { staticClass: "typo__p" }, [
                          _vm._v("Please fill the form correctly.")
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.submitStatus === "PENDING"
                      ? _c("p", { staticClass: "typo__p" }, [
                          _vm._v("Sending...")
                        ])
                      : _vm._e()
                  ])
                ]
              )
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-6" }, [
      _c("h1", { staticClass: "m-0 text-dark" }, [
        _c("i", { staticClass: "nav-icon fas fa-tachometer-alt" }),
        _vm._v(
          "\n                        PAGU ANGGARAN OPD / SKPD\n                    "
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h3", { staticClass: "card-title" }, [
        _vm._v("Tambah Pagu Anggaran OPD / SKPD")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/FormValidation.vue":
/*!***********************************************!*\
  !*** ./resources/js/pages/FormValidation.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FormValidation.vue?vue&type=template&id=280fb0b4& */ "./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4&");
/* harmony import */ var _FormValidation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FormValidation.vue?vue&type=script&lang=js& */ "./resources/js/pages/FormValidation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _FormValidation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/FormValidation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/FormValidation.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/pages/FormValidation.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FormValidation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./FormValidation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/FormValidation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FormValidation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4&":
/*!******************************************************************************!*\
  !*** ./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./FormValidation.vue?vue&type=template&id=280fb0b4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/FormValidation.vue?vue&type=template&id=280fb0b4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FormValidation_vue_vue_type_template_id_280fb0b4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);