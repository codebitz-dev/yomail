module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    variants: {
        backgroundColor: ['hover', 'responsive', ' focus', 'dark'],
        textColor: ['hover', 'responsive', 'focus', 'dark'],
    },
    plugins: [
        require('tailwind-scrollbar'),
    ],
}
