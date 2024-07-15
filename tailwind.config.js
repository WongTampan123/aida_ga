/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "node_modules/preline/dist/*.js"
  ],
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
    require('preline/plugin')
  ],
}

