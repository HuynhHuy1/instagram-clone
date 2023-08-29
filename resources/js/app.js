import "./bootstrap";

import Alpine from "alpinejs";
window.Alpine = Alpine;


Alpine.start();

$(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
}); 
