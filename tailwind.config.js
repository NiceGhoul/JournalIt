import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/bootstrap/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Figtree", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        customDark: "#2d2d2d",
        theme: "#0674B4",
        themeLight: "#57C1FF",
        analytic: "#82B9D9",
      },
    },
  },
  plugins: [],
};
