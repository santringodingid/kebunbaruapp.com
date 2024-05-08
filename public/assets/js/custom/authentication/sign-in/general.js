"use strict";var KTSigninGeneral=function(){var t,n,i;return{init:function(){t=document.querySelector("#kt_sign_in_form"),n=document.querySelector("#kt_sign_in_submit"),i=FormValidation.formValidation(t,{fields:{email:{validators:{regexp:{regexp:/^[^\s@]+@[^\s@]+\.[^\s@]+$/,message:"Email tidak valid"},notEmpty:{message:"Email harus diisi"}}},password:{validators:{notEmpty:{message:"Password harus diisi"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}}),!function(t){try{return new URL(t),!0}catch(t){return!1}}(n.closest("form").getAttribute("action"))?n.addEventListener("click",(function(e){e.preventDefault(),i.validate().then((function(i){"Valid"==i?(n.setAttribute("data-kt-indicator","on"),n.disabled=!0,setTimeout((function(){n.removeAttribute("data-kt-indicator"),n.disabled=!1,Swal.fire({text:"Proses login sukses!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, lanjut!",customClass:{confirmButton:"btn btn-primary"}}).then((function(n){if(n.isConfirmed){t.querySelector('[name="email"]').value="",t.querySelector('[name="password"]').value="";var i=t.getAttribute("data-kt-redirect-url");i&&(location.href=i)}}))}),2e3)):Swal.fire({text:"Oppss.. Ada yang salah, nih. Coba lagi!",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok!",customClass:{confirmButton:"btn btn-primary"}})}))})):n.addEventListener("click",(function(e){e.preventDefault(),i.validate().then((function(i){"Valid"==i?(n.setAttribute("data-kt-indicator","on"),n.disabled=!0,axios.post(n.closest("form").getAttribute("action"),new FormData(t)).then((function(n){if(n){t.reset(),Swal.fire({text:"Proses login sukses!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok!",customClass:{confirmButton:"btn btn-primary"}});const n=t.getAttribute("data-kt-redirect-url");n&&(location.href=n)}else Swal.fire({text:"Oppss.. Ada yang salah, nih. Coba lagi!",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})})).catch((function(t){Swal.fire({text:"Oppss.. Ada yang salah, nih. Coba lagi!",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})})).then((()=>{n.removeAttribute("data-kt-indicator"),n.disabled=!1}))):Swal.fire({text:"Oppss.. Ada yang salah, nih. Coba lagi!",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();KTUtil.onDOMContentLoaded((function(){KTSigninGeneral.init()}));
