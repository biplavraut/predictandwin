"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_backend_quiz_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
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
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  /*Filling the data into form*/
  data: function data() {
    return {
      totalData: 0,
      fields: ['images', 'title', 'category', 'status', 'points', 'active_at', 'answer', 'actions'],
      data: {
        data: []
      },
      form: new Form({
        id: ""
      })
    };
  },
  methods: {
    /*===== Start of pagination function =====*/
    getResults: function getResults() {
      var _this = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      axios.get("/admin/quiz?page=" + page).then(function (response) {
        _this.data = response.data;
      });
    },

    /*==== Call Delete Modal uith user id ====*/
    deleteData: function deleteData(id) {
      var _this2 = this;

      swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(function (result) {
        //send an ajax request to the server
        if (result.value) {
          _this2.form["delete"]("/admin/quiz/" + id).then(function (_ref) {
            var data = _ref.data;

            _this2.serverResponse(data);
          })["catch"](function () {
            swal.fire("Error!", "Something Went wrong!", "error");
          });
        }
      });
    },

    /*==== End of Delete Modal ====*/

    /*==== Start of Show existing User function ====*/
    loadData: function loadData() {
      var _this3 = this;

      if (this.$gate.isDevOrAdmin()) {
        axios.get("/admin/quiz").then(function (_ref2) {
          var data = _ref2.data;
          return _this3.data = data, _this3.totalData = data.meta.total;
        });
      }
    }
    /*==== End of existing User ====*/

  },
  created: function created() {
    var _this4 = this;

    // Fire.$on("searching", () => {
    //     let query = this.$parent.search; //take information from root
    //     axios
    //         .get("/admin/findCategory?q=" + query)
    //         .then(data => {
    //             this.data = data;
    //         })
    //         .catch(() => {});
    // });
    this.loadData(); //load the user in the table
    //Load the data if add or created a new user

    Fire.$on("AfterCreate", function () {
      _this4.loadData();
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.nav-pills {\r\n    border-bottom: none;\r\n    padding-bottom: none;\n}\n.blurry-text {\r\n   color: transparent;\r\n   text-shadow: 0 0 5px rgba(0,0,0,0.5);\n}\n.unselectable {\r\n    -webkit-touch-callout: none;\r\n    -webkit-user-select: none;\r\n    -moz-user-select: none;\r\n    -ms-user-select: none;\r\n    user-select: none;\n}\n.blurry-text:hover {\r\n   color: #71c016;\r\n   text-shadow: none;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/backend/quiz/Index.vue":
/*!*********************************************!*\
  !*** ./resources/js/backend/quiz/Index.vue ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=e888375e& */ "./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js&");
/* harmony import */ var _Index_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Index.vue?vue&type=style&index=0&lang=css& */ "./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__.render,
  _Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/backend/quiz/Index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************!*\
  !*** ./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=style&index=0&lang=css&");


/***/ }),

/***/ "./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e&":
/*!****************************************************************************!*\
  !*** ./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e& ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_e888375e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=template&id=e888375e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/quiz/Index.vue?vue&type=template&id=e888375e& ***!
  \*******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "col-lg-12 grid-margin stretch-card" },
    [
      _c(
        "b-card",
        {
          attrs: {
            footer:
              "Showing " + _vm.data.data.length + " data of " + _vm.totalData,
            "footer-tag": "footer",
            "no-body": ""
          }
        },
        [
          _c(
            "b-card-header",
            [
              _c(
                "b-row",
                [
                  _c("b-col", [
                    _c("h4", { staticClass: "card-title" }, [
                      _vm._v("Category List")
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "card-description" }, [
                      _vm._v("\n                    Total categories "),
                      _c("code", [_vm._v(_vm._s(_vm.totalData))])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "b-col",
                    [
                      _c(
                        "b-nav",
                        { staticClass: "nav-pills justify-content-end" },
                        [
                          _c(
                            "b-nav-item",
                            {
                              staticClass: "mr-2 mr-md-0",
                              attrs: {
                                to: { name: "quiz.create" },
                                "link-classes": "py-2 px-3"
                              }
                            },
                            [
                              _c("span", { staticClass: "d-none d-md-block" }, [
                                _c("i", { staticClass: "ti-plus" }),
                                _vm._v(" Add New Quiz")
                              ]),
                              _vm._v(" "),
                              _c("span", { staticClass: "d-md-none" }, [
                                _c("i", { staticClass: "ti-plus" }),
                                _vm._v(" Add")
                              ])
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.$gate.isAuthorized()
            ? _c("b-table", {
                attrs: {
                  items: _vm.data.data,
                  fields: _vm.fields,
                  "sticky-header": "500px",
                  "head-variant": "dark",
                  outlined: "",
                  striped: "",
                  responsive: "sm"
                },
                scopedSlots: _vm._u(
                  [
                    {
                      key: "cell(images)",
                      fn: function(row) {
                        return [
                          _c("b-img", {
                            attrs: {
                              src: row.item.image,
                              fluid: "",
                              alt: "Responsive image"
                            }
                          })
                        ]
                      }
                    },
                    {
                      key: "cell(status)",
                      fn: function(row) {
                        return [
                          row.item.daily
                            ? _c("span", [_vm._v("Daily Quiz")])
                            : _vm._e(),
                          _vm._v(" | "),
                          row.item.display
                            ? _c("span", [_vm._v("Display")])
                            : _vm._e(),
                          _vm._v(" "),
                          _c("br"),
                          _vm._v(" "),
                          row.item.take_a_quiz
                            ? _c("span", [_vm._v("Take a Quiz")])
                            : _vm._e(),
                          _vm._v(" |  "),
                          row.item.featured
                            ? _c("span", [_vm._v("Featured")])
                            : _vm._e()
                        ]
                      }
                    },
                    {
                      key: "cell(points)",
                      fn: function(row) {
                        return [
                          _vm._v(
                            "\n                " +
                              _vm._s(row.item.point) +
                              " | "
                          ),
                          _c("b", [_vm._v(_vm._s(row.item.premium_point))])
                        ]
                      }
                    },
                    {
                      key: "cell(active_at)",
                      fn: function(row) {
                        return [
                          _vm._v("\n                From: "),
                          _c("b", [
                            _vm._v(
                              _vm._s(_vm._f("myDayDate")(row.item.start_at))
                            )
                          ]),
                          _vm._v(" "),
                          _c("br"),
                          _vm._v("\n                To: "),
                          _c("b", [
                            _vm._v(_vm._s(_vm._f("myDayDate")(row.item.end_at)))
                          ])
                        ]
                      }
                    },
                    {
                      key: "cell(answer)",
                      fn: function(row) {
                        return [
                          _c(
                            "span",
                            { staticClass: "blurry-text unselectable" },
                            [_vm._v(_vm._s(row.item.answers))]
                          )
                        ]
                      }
                    },
                    {
                      key: "cell(actions)",
                      fn: function(row) {
                        return [
                          _c(
                            "router-link",
                            {
                              staticClass: "btn btn-sm btn-success",
                              attrs: {
                                to: {
                                  name: "quiz.edit",
                                  params: { id: row.item.id }
                                }
                              }
                            },
                            [
                              _c("span", { staticClass: "d-none d-md-block" }, [
                                _c("i", { staticClass: "ti-pencil" }),
                                _vm._v("\n                        Edit")
                              ]),
                              _vm._v(" "),
                              _c("span", { staticClass: "d-md-none" }, [
                                _c("i", { staticClass: "ti-pencil" })
                              ])
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "btn btn-sm btn-danger",
                              attrs: { href: "#" }
                            },
                            [
                              _c("span", { staticClass: "d-none d-md-block" }, [
                                _c("i", { staticClass: "ti-trash" }),
                                _vm._v("\n                        Delete")
                              ]),
                              _vm._v(" "),
                              _c("span", { staticClass: "d-md-none" }, [
                                _c("i", { staticClass: "ti-trash" })
                              ])
                            ]
                          )
                        ]
                      }
                    }
                  ],
                  null,
                  false,
                  986218009
                )
              })
            : _vm._e(),
          _vm._v(" "),
          _c("pagination", {
            staticClass: "justify-content-center",
            attrs: { data: _vm.data },
            on: { "pagination-change-page": _vm.getResults }
          })
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);