/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/views/**/*.php"],
    theme: {
        extend: {
            colors: {
                yellow: {
                    1000: '#1c0a01',
                },
            },
            fontFamily: {
                bebas: '"Bebas Neue"',
                pixelify: '"Pixelify Sans"',
                pressstart: '"Press Start 2P"',
                teko: 'Teko',
                wavefont: 'Wavefont'
                // audiowide
                // iceland
                // electrolize
            },
            animation: {
                wiggle: 'wiggle 0.15s ease-in-out infinite',
                wave: 'wave 0.5s ease-in-out infinite',
                'pulse-up': 'pulse-up 1s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
                'pulse-up': {
                    '0%, 100%': { opacity: 'var(--opacity-max)' },
                    '50%': { opacity: 'var(--opacity-min)' },
                }
            }
        },
    },
    plugins: [],
}

