const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColer',

                black: colors.black,
                white: colors.white,
                'gray-background': '#F7F8FC',
                'blue': '#328af1', //btn classic
                'blue-hover': '#2879bd', // btn hover
                'yellow': '#ffc73c', //in progress
                'red': '#ec454f', //closed
                'red-100': '#fee2e2', //rouge pâle
                'green': '#1aab8b', // implemented
                'green-50': '#f0fdf4',
                'purple': '#6B21A8', // considering
            },
            spacing: {
                22: '5.5rem',
                44: '11rem',
                70: '17.5rem',
                76: '19rem',
                104: '26rem',
                128: '32rem',
                175: '45rem',
                180: '49rem',
            },
            maxWidth: {
                small: '7rem',
                custom: '68.5rem',

            },
            boxShadow: {
                card: '4px 4px 15px 0 rgba(36, 37, 38, 0.08)', 
                dialog: '3px 4px 15px 0 rgba(36, 37, 38, 0.22)'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: ['0.625rem', { lineHeight: '1rem' }],
            }
        },
    },

    plugins: [require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/line-clamp')
],
};
