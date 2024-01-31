"use strict";

require("./bootstrap");

var _vue = require("vue");

var _ComponentA = _interopRequireDefault(require("./components/ComponentA.vue"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

(0, _vue.createApp)(_ComponentA["default"]).mount('#componente-a'); // const app = createApp({});
// app.component('component-a', ComponentA);
// app.mount("#app");