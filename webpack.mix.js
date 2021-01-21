const mix = require('laravel-mix');
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

mix.ts('resources/js/app.ts', 'public/js').vue()
   .sass('resources/css/app.scss', 'public/css').options({ postCss: [ require('tailwindcss') ] })
   .polyfill({
      enabled: true,
      useBuiltIns: "usage",
      targets: false,
      debug: false,
    })
   .extract();

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps().browserSync(process.env.APP_URL);
}
