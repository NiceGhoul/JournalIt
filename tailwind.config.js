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
        themeLighter: "#08A4FF",
        analytic: "#82B9D9",
        cardHome: "#EDB1B1",
        cardHomeText: "#6B5050",
        customBlue: "#0674B4",
      },
      boxShadow: {
        custom: "10px 10px 15px rgba(0, 0, 0, 0.8)",
      },
    },
  },
  plugins: [],
};
