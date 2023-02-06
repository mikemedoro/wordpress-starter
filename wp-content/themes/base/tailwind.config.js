/** @type {import('tailwindcss).Config} */

const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

module.exports = {
  content: ['./views/**/*.twig', './assets/scripts/modules/**/*.js'],
  safelist: ['.btn'],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.neutral,
      red: colors.red,
      primary: {
        light: '#6ba1f0',
        DEFAULT: '#1e70e8',
        dark: '#104ba1',
      },
      secondary: {
        light: '#7bd4c0',
        DEFAULT: '#3ebca0',
        dark: '#297c6a',
      },
    },
    fontFamily: {
      sans: ['Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif'],
      serif: ['Georgia', 'Times New Roman', 'Times', 'serif'],
    },
    screens: {
      mobile: { max: '639px' },
      tablet: { max: '767px' },
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1440px',
    },
    extend: {
      fontSize: {
        md: '0.938rem',
      },
      spacing: {
        13: '3.25rem',
        15: '3.75rem',
        17: '4.25rem',
        18: '4.5rem',
        19: '4.75rem',
        25: '6.25rem',
      },
      maxWidth: {
        '8xl': '86rem',
        '9xl': '100rem',
        '10xl': '120rem',
      },
      transitionProperty: {
        visibility: 'visibility, opacity',
      },
      transitionTimingFunction: {
        smooth: 'cubic-bezier(0.77, 0, 0.175, 1)',
      },
      zIndex: {
        1: '1',
        2: '2',
        '-1': '-1',
      },
    },
  },
  corePlugins: {
    container: false,
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
};
