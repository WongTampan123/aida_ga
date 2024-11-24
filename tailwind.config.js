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
      fontSize:{
        '2xs': ['10px', '12px']
      },
      screens: {
        '2xs' : '400px',
        "xl" : "1380px"
      },
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


