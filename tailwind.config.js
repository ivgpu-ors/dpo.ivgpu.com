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
    extend: {
      colors: {
        primary: {
          light: '#9bb8d4',
          DEFAULT: '#6699cc',
          dark: '#406b96'
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
    extend: {},
  },
  plugins: [],
}
