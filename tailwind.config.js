/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
export default {
    content: [
        "./resources/**/*.vue",
        "./resources/**/*.js",
        "resources/**/*.blade.php",
        "./formkit.config.js",
        "./node_modules/vue-tailwind-datepicker/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                "vtd-primary": colors.blue,
            },
        },
    },
    plugins: [],
};
