import "../../styles/home/index.scss";
import Rellax from "rellax";
import Flickity from "flickity";

let greetingParallaxBg = new Rellax(".bg-img", {
  breakpoints: [0, 0, 768],
  center: false,
  wrapper: null,
  round: true,
  vertical: true,
  horizontal: false,
});

new Flickity(".about__slider", {
  wrapAround: true,
});

const content = document.querySelector(".greeting__content"),
  separator = document.querySelector(".header-separator");

window.onload = () => {
  content.style.opacity = 1;
  separator.style.width = "50%";
};