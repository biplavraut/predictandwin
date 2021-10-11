"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[631],{3195:(t,a,e)=>{e.d(a,{Z:()=>i});var n=e(3645),s=e.n(n)()((function(t){return t[1]}));s.push([t.id,".nav-pills{border-bottom:none;padding-bottom:none}",""]);const i=s},7631:(t,a,e)=>{e.r(a),e.d(a,{default:()=>l});const n={data:function(){return{totalData:0,fields:["images","business_name","name","email","phone","type","enabled","created_at","actions"],data:{data:[]},form:new Form({id:""})}},methods:{getResults:function(){var t=this,a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;axios.get("/admin/partner?page="+a).then((function(a){t.data=a.data}))},deleteAdmin:function(t){var a=this;swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(e){e.value&&a.form.delete("/admin/partner/"+t).then((function(t){var e=t.data;a.serverResponse(e)})).catch((function(){swal.fire("Error!","Something Went wrong!","error")}))}))},loadData:function(){var t=this;this.$gate.isDevOrAdmin()&&axios.get("/admin/partner").then((function(a){var e=a.data;return t.data=e,t.totalData=e.meta.total}))}},created:function(){var t=this;this.loadData(),Fire.$on("AfterCreate",(function(){t.loadData()}))}};var s=e(3379),i=e.n(s),r=e(3195),o={insert:"head",singleton:!1};i()(r.Z,o);r.Z.locals;const l=(0,e(1900).Z)(n,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"col-lg-12 grid-margin stretch-card"},[e("b-card",{attrs:{footer:"Showing "+t.data.data.length+" data of "+t.totalData,"footer-tag":"footer","no-body":""}},[e("b-card-header",[e("b-row",[e("b-col",[e("h4",{staticClass:"card-title"},[t._v("Partner List")]),t._v(" "),e("p",{staticClass:"card-description"},[t._v("\n                    Total partners "),e("code",[t._v(t._s(t.totalData))])])]),t._v(" "),e("b-col",[e("b-nav",{staticClass:"nav-pills justify-content-end"},[e("b-nav-item",{staticClass:"mr-2 mr-md-0",attrs:{to:{name:"partner.create"},"link-classes":"py-2 px-3"}},[e("span",{staticClass:"d-none d-md-block"},[e("i",{staticClass:"ti-plus"}),t._v(" Add New Partner")]),t._v(" "),e("span",{staticClass:"d-md-none"},[e("i",{staticClass:"ti-plus"}),t._v(" Add")])])],1)],1)],1)],1),t._v(" "),t.$gate.isAuthorized()?e("b-table",{attrs:{items:t.data.data,fields:t.fields,"sticky-header":"500px","head-variant":"dark",outlined:"",striped:"",responsive:"sm"},scopedSlots:t._u([{key:"cell(images)",fn:function(t){return[e("b-img",{attrs:{src:t.item.image,fluid:"",alt:"Responsive image"}})]}},{key:"cell(created_at)",fn:function(a){return[e("i",[t._v(t._s(t._f("myDate")(a.created_at)))])]}},{key:"cell(actions)",fn:function(a){return[e("router-link",{staticClass:"btn btn-sm btn-success",attrs:{to:{name:"partner.edit",params:{id:a.item.id}}}},[e("span",{staticClass:"d-none d-md-block"},[e("i",{staticClass:"ti-pencil"}),t._v("\n                        Edit")]),t._v(" "),e("span",{staticClass:"d-md-none"},[e("i",{staticClass:"ti-pencil"})])]),t._v(" "),e("a",{staticClass:"btn btn-sm btn-danger",attrs:{href:"#"}},[e("span",{staticClass:"d-none d-md-block"},[e("i",{staticClass:"ti-trash"}),t._v("\n                        Delete")]),t._v(" "),e("span",{staticClass:"d-md-none"},[e("i",{staticClass:"ti-trash"})])])]}}],null,!1,3465306507)}):t._e(),t._v(" "),e("pagination",{staticClass:"justify-content-center",attrs:{data:t.data},on:{"pagination-change-page":t.getResults}})],1)],1)}),[],!1,null,null,null).exports}}]);