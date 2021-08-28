let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss')

/**
 * Mix Asset Management
 *
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your application. By default we compile the Sass file as well as
 * bundling up all the JS files
 */

mix.sourceMaps().webpackConfig({devtool: 'source-map'})
	.sass('src/sass/style.scss', 'styles')
	.sass('src/sass/editor-styles.scss', 'styles')
	.js('src/js/index.js', 'scripts')
	.js('src/js/editor.js', 'scripts')
	.options({
		processCssUrls: false,
		postCss: [ tailwindcss('./tailwind.config.js') ]
	})
	.setPublicPath('dist');

mix.browserSync({
	proxy: 'https://hollywoodpark.local'
})
