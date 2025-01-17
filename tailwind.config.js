module.exports = {
    mode: "jit",
    darkMode: true, // or 'media' or 'class'
    prefix: "ud-",
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors : {
            "mecctech-red": {
                50: "#fde8ea",   // Lightest
                100: "#fbd1d4",  // Very light
                200: "#f6a3a8",  // Light
                300: "#f1757c",  // Light-medium
                400: "#ed4750",  // Medium
                500: "#e30613",  // Base color
                600: "#cc0511",  // Dark-medium
                700: "#b3050f",  // Dark
                800: "#8e040c",  // Very dark
                900: "#6a0309",  // Darkest
            },
            black: "#090E34",
            dark: "#1D2144",
            primary: "#e30613",
            yellow: "#FBB040",
            "body-color": "#959CB1",
            "whatsapp-green" : "#25D366"
        },
        screens: {
            sm: "540px",
            // => @media (min-width: 576px) { ... }

            md: "720px",
            // => @media (min-width: 768px) { ... }

            lg: "960px",
            // => @media (min-width: 992px) { ... }

            xl: "1140px",
            // => @media (min-width: 1200px) { ... }

            "2xl": "1320px",
            // => @media (min-width: 1400px) { ... }
        },
        container: {
            center: true,
            padding: "16px",
        },
        boxShadow: {
            signUp: "0px 5px 10px rgba(4, 10, 34, 0.2)",
            image: "0px 3px 30px rgba(9, 14, 52, 0.1)",
            pricing: "0px 34px 68px rgba(0, 0, 0, 0.06)",
            testimonial: "0px 8px 40px -10px rgba(9, 14, 52, 0.1)",
            service: "0px 11px 41px -11px rgba(9, 14, 52, 0.1)",
            blog: "0px 40px 150px -35px rgba(0, 0, 0, 0.05)",
        },
    width: {
        '1/16' : '6.25%',
        '1/20' : '5%',
        '100' : '25rem',
        '120' : '30rem',
        '140' : '35rem',
        '160' : '40rem',
        '200' : '50rem',
        '240' : '60rem',
    },
    height: {
        '100' : '25rem',
        '120' : '30rem',
        '140' : '35rem',
        '160' : '40rem',
    }
    }
  },
  plugins: [],
}
