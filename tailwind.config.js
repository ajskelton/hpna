module.exports = {
	theme: {
		screens: {
			// xs: '400px',
			sm: '640px',
			md: '768px',
			lg: '1024px',
			xl: '1240px',
		},
		fontSize: {
			'xs': '1.2rem',
			'sm': '1.4rem',
			'base': '1.6rem',
			'lg': '1.8rem',
			'xl': '2rem',
			'2xl': '2.4rem',
			'3xl': '3rem',
			'4xl': '3.6rem',
			'5xl': '4.8rem',
			'6xl': '6.4rem',
		},
		extend: {
			colors: {
				lightGreen: '#66CC33',
				green: '#719E40',
				olive: '#5F6324',
			},
			maxWidth: {
				'7xl': '80rem',
				'8xl': '112rem'
			}
		},
	},
	variants: {
		visibility: ['group-hover']
	},
	plugins: []
}
