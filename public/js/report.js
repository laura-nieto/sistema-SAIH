/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/report.js ***!
  \********************************/
var select = document.getElementById('tipo_reporte'),
    form = document.getElementById('reportar'),
    btn_send = document.getElementById('send');
btn_send.addEventListener('click', function (e) {
  var value = select.value;

  if (value == 1) {
    form.action = "/reportes/colaborador";
  } else if (value == 2) {
    form.action = "/reportes/cuestionario";
    form.submit();
  } else {
    alert('error');
  }
});
/******/ })()
;