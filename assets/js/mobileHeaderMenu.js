let navBurger = document.querySelector(".header__burger"),
  navLinks = document.querySelectorAll(".header__link");

navBurger.addEventListener("click", toggleNavMenu);
navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    if (getComputedStyle(navBurger).display !== "none") toggleNavMenu();
  });
});

function toggleNavMenu() {
  let navMenu = document.querySelector(".header__nav"),
    burgerStripes = document.querySelectorAll(".header__burger-strip");

  navMenu.classList.toggle("header__nav--mobile-active");
  if (navMenu.classList.contains("header__nav--mobile-active")) {
    burgerStripes.forEach((n) =>
      n.classList.add("header__burger-strip--active")
    );
    document.body.style.overflow = 'hidden';
  } else {
    burgerStripes.forEach((n) =>
      n.classList.remove("header__burger-strip--active")
    );
    document.body.style.overflow = 'unset';
  }
}
