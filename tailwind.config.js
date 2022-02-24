module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors : {
            "mecctech-red" : "#e30613"
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
