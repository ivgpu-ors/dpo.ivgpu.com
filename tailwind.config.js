module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.ts',
    './resources/**/*.jsx',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      'head': ['Montserrat', 'sans-serif'],
    },
    container: {
      center: true,
    },
    extend: {
      colors: {
        primary: {
          light: '#50c2ff',
          DEFAULT: '#007bff',
          dark: '#0055d4'
        },
        accent: {
          light: '#f29992',
          DEFAULT: '#fe5f55',
          dark: '#d32519'
        },
        dark: '#001427',
        light: '#EEF4ED',
        jasmine: '#F4D58D'
      }
    },
  },
  variants: {
    extend: {
      borderWidth: ['last'],
    },
  },
  plugins: [],
}
