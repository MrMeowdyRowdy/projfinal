"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vite = require("vite");

var _laravelVitePlugin = _interopRequireDefault(require("laravel-vite-plugin"));

var _pluginVue = _interopRequireDefault(require("@vitejs/plugin-vue"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/sass/app.scss',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
// });
var _default = (0, _vite.defineConfig)({
  plugins: [(0, _laravelVitePlugin["default"])({
    input: ['resources/css/app.css', 'resources/js/app.js'],
    refresh: true
  }), (0, _pluginVue["default"])()],
  resolve: {
    alias: {
      '@': '/resources/js',
      'vue': 'vue/dist/vue.esm-bundler.js'
    }
  }
});

exports["default"] = _default;