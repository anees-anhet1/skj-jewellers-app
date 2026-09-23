/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        gold: {
          50: '#fbf6e9',
          100: '#f5e9c6',
          200: '#eed89a',
          300: '#e3c467',
          400: '#d4af37', // primary gold
          500: '#bd9530',
          600: '#9c7a26',
          700: '#7a5f1e',
          800: '#5a4516',
          900: '#3d2e0f',
        },
        ink: {
          900: '#0b0b0c',
          800: '#141416',
          700: '#1d1d20',
        }
      },
      fontFamily: {
        serif: ['"Playfair Display"', 'serif'],
        sans: ['"Inter"', 'sans-serif'],
      },
      boxShadow: {
        luxe: '0 10px 40px -10px rgba(212,175,55,0.35)',
      }
    },
  },
  plugins: [],
}
