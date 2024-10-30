/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './front-page.php',
    './header.php',
    './index.php',
    './footer.php',
    './404.php',
    './inc/*.php',
    './page-templates/**/*.php',
    './template-parts/**/*.php',
  ],
  theme: {
    fontFamily: {
      sans: ['dm-sans', 'sans-serif'],
      poppins: ['Poppins', 'sans-serif'],
      miller: [ 'miller-headline', 'serif']
    },

    extend: {
      letterSpacing: {
        //wide: '.038em',
        //wider: '.06em',
      },
      colors: {
        'orange-shade': '#F48123',
        'blue-shade': '#005AA9',
        'white-shade': '#EFEFEF',
        'dark-blue-shade': '#001629',
        'darker-blue-shade': '#050B20',
        'beige-shade': '#FFEDDE',
        'light-blue-shade': '#E6F0FA',
        'green-shade-1': '#0E434A',
        'purple-shade-1': '#3B1C43'
      },
      transitionTimingFunction: {
        //'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      gridTemplateRows: {
        // Allow grid rows to auto size based on content
        'masonry': 'masonry',
      },
    },
  },
  plugins: [
  ],
}
