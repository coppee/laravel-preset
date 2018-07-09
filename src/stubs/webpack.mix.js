let mix = require('laravel-mix')
require('laravel-mix-purgecss')

mix
  .js('resources/assets/Open/js/app.js', 'public/assets/open/js')
  .sass('resources/assets/Open/scss/app.scss', 'public/assets/open/css')
  .purgeCss()
  .options({
    postCss: [
      require('autoprefixer')(),
    ],
    processCssUrls: false, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
    //purifyCss: true, // Remove unused CSS selectors.
  })
  .webpackConfig({
    module: {
      rules: [{
        test: /\.js?$/,
        use: [{
          loader: 'babel-loader',
          options: mix.config.babel()
        }]
      }]
    }
  })
  .sourceMaps()
  .disableNotifications()

if (mix.inProduction()) {
  mix.version()
}
