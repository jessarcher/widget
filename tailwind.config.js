/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/views/**/*.php"],
    theme: {
        extend: {
            fontFamily: {
                bebas: '"Bebas Neue"',
                pixelify: '"Pixelify Sans"',
                pressstart: '"Press Start 2P"',
                teko: 'Teko',
                wavefont: 'Wavefont'
            },
            animation: {
                wiggle: 'wiggle 0.15s ease-in-out infinite',
                wave: 'wave 0.5s ease-in-out infinite'
            },
            keyframes: {
                wiggle: {
                    '0%, 100%': { transform: 'rotate(-4deg)' },
                    '50%': { transform: 'rotate(4deg)' },
                },
                wave: {
                    '0%, 100%': { transform: 'scaleY(calc(var(--tw-scale-y) * 1))' },
                    '50%': { transform: 'scaleY(calc(var(--tw-scale-y) * 0.5))' },
                },
            }
        },
    },
    plugins: [],
}

