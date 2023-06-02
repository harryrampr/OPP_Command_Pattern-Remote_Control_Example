/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js,php}"],
  theme: {
    extend: {
      spacing: {
        '128': '32rem',
        '192': '48rem',
        '256': '64rem',
      }},
  },
  plugins: [],
}