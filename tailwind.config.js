const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        extend: {
            screens: {
                xs: { max: "639px" }, // Applies to screens *below* 640px
            },
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#4A90E2",
                secondary: "#E74C3C",
                tertiary: "#1ABC9C",
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    content: [
        "./app/**/*.php",
        "./resources/**/*.html",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.tsx",
        "./resources/**/*.php",
        "./resources/**/*.vue",
        "./resources/**/*.twig",
        "./node_modules/flowbite/**/*.js",
    ],
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
    ],
};
