/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "custom-blue": "rgba(27, 86, 120, 1)",
                "custom-red": "rgba(238, 105, 105, 1)",
            },
        },
    },
    plugins: [],
};
