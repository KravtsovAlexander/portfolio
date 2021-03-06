import validator from "./Validator.js";
import {checkForm, toggleDeleteBtn} from "./formFunctions";
import "../css/genres/genres.scss";

const genre = document.getElementById("genre");
const validationRules = {
  genreRule: {
    elem: genre,
    minLength: 1,
    maxLength: genre.dataset["length"],
    type: "text",
  },
};

const form = document.forms["add_genre"];
form.addEventListener("submit", (event) => {
  event.preventDefault();
  if (checkForm(validationRules, validator)) {
    form.submit();
  }
});

let checkboxes = document.getElementsByName("delete[]"),
  deleteBtn = document.getElementById("delete_btn");
checkboxes.forEach(chbx => {
  chbx.addEventListener("change", toggleDeleteBtn.bind(null, checkboxes, deleteBtn));
});