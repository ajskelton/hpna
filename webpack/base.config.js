const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

function recursiveIssuer(m) {
	if (m.issuer) {
		return recursiveIssuer(m.issuer);
	} else if (m.name) {
		return m.name;
	} else {
		return false;
	}
}

module.exports = {
	context: path.resolve(__dirname, '../src'),
	entry: {
		app: './js/index.js',
		editor: './js/editor.js'
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				appStyles: {
					name: 'app',
					test: (m, c, entry = 'app') =>
						m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
					chunks: 'all',
					enforce: true,
				},
				editorStyles: {
					name: 'editor',
					test: (m, c, entry = 'editor') =>
						m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
					chunks: 'all',
					enforce: true,
				}
			}
		}
	},
	plugins: [
		new MiniCssExtractPlugin({
			moduleFilename: ({ name }) =>  `/css/${name.replace('app', '../../style')}.css`,
		})
	],
	module: {
		rules: [
			{
				test: /\.(css|scss)$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					{
						loader: 'postcss-loader' },
					{
						/* for ~slick-carousel/slick/slick-theme.scss */
						loader: 'resolve-url-loader' },
					{
						/* for resolver-url-loader:
							source maps must be esnabled on any preceding loader */
						loader: 'sass-loader?sourceMap' }
				]
			}
		]
	}
}