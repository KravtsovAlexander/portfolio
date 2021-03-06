import "../../styles/projects/index.scss";
const Flickity = require("flickity-fade");

const sliders = document.querySelectorAll(".projects__media");
sliders.forEach((slider) => {
  new Flickity(slider, {
    wrapAround: true,
    pageDots: false,
    prevNextButtons: false,
    autoPlay: 6000,
    draggable: true,
    pauseAutoPlayOnHover: false,
    fade: true,
  });
});
