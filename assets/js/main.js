'use strict';
$.fn.serializeObject = function() {
  var o = {};
  var a = this.serializeArray();
  $.each(a, function() {
      if (o[this.name]) {
          if (!o[this.name].push) {
              o[this.name] = [o[this.name]];
          }
          o[this.name].push(this.value || '');
      } else {
          o[this.name] = this.value || '';
      }
  });
  return o;
};

function url_semantic(params) {
    var url = "";
    $.each(params, function (key, value) {
      if ($.isArray(params[key])) {
        var tiene_valor = 0;
        $.each(params[key], function (key2, value2) {
          if (value2 != "") {
            if (tiene_valor == 0) {
              tiene_valor = 1;
              url += "/" + key.replace("[]", "") + "/" + value2;
            } else {
              url += "-" + value2;
            }
          }
        });
      } else {
        if (value != "") {
          url += "/" + key + "/" + value;
        }
      }
    });
    return url;
  }