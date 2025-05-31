// tailwind.config.js
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Ajoutez votre couleur personnalisée ici
                'bleu-ciel': '#0ea5e9', // Notre bleu ciel d'exemple
                // Vous pourriez ajouter d'autres nuances si besoin
                 'bleu-ciel-clair': '#7dd3fc',
                 'bleu-ciel-fonce': '#0369a1',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};