module.exports = {
	theme: {
		screens: {
			// xs: '400px',
			sm: '640px',
			md: '768px',
			lg: '1024px',
			xl: '1024px',
		},
		extend: {
			colors: {
				red: '#C0272D',
				dark: '#303030',
			},
			maxWidth: {
				'7xl': '80rem',
				'8xl': '112rem'
			}
		},
	},
	variants: {
		sisibility: ['group-hover']
	},
	plugins: []
}
