/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "node_modules/preline/dist/*.js",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  darkMode: false,
  theme: {
    extend:{
      colors:{
        green:{
          'aida':'#17C653'
        }
      }
    }
  },
  plugins: [
    require('preline/plugin'),
    require('@tailwindcss/forms'),
    require('daisyui')
  ]
}


