const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-polyfill');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .ts('resources/js/app.ts', 'public/js').vue()
  .ts('resources/js/backend/app.ts', 'public/js/backend').vue()
  .alias({
    '@backend': path.join(__dirname, 'resources/js/backend'),
    '@svg': path.join(__dirname, 'resources/svg'),
    'vue$': path.join(__dirname, 'node_modules/vue/dist/vue.esm-bundler.js')
  })
  .sass('resources/css/app.scss', 'public/css').options({ postCss: [require('tailwindcss')] })
  .sass('resources/css/backend/app.scss', 'public/css/backend').options({ postCss: [require('tailwindcss')] })
  .polyfill({
    enabled: true,
    useBuiltIns: "usage",
    targets: false,
    debug: false,
  })
  .extract();

mix.webpackConfig({
  module: {
    rules: [{
      test: /\.vue$/,
      use: [{
        loader: "vue-svg-inline-loader",
        options: { /* ... */ }
      }]
    }]
  }
});

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps(false, 'source-map').browserSync(process.env.APP_URL);
}
