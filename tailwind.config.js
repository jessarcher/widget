/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/views/**/*.php"],
    theme: {
        extend: {
            colors: {
                yellow: {
                    1000: '#1c0a01',
                },
                amber: {
                    1000: '#0e0501',
                },
            },
            fontFamily: {
                bebas: '"Bebas Neue"',
                pixelify: '"Pixelify Sans"',
                pressstart: '"Press Start 2P"',
                teko: 'Teko',
                wavefont: 'Wavefont',
                dosis: 'Dosis',
                orbitron: 'Orbitron',
                // audiowide
                // iceland
                // electrolize
            },
            fontSize: {
                '10xl': '10rem',
            },
            animation: {
                wiggle: 'wiggle 0.15s ease-in-out infinite',
                wave: 'wave 0.5s ease-in-out infinite',
                'pulse-up': 'pulse-up 1s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                flash: 'flash 1s infinite',
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
                },
                flash: {
                    '0%': { opacity: '0' },
                    '50%': { opacity: '0' },
                    '51%': { opacity: '1' },
                }
            }
        },
    },
    plugins: [],
}

