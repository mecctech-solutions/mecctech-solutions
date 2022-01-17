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
    }
    }
  },
  plugins: [],
}
