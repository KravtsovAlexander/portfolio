import validator from "./Validator.js";
import {checkForm, toggleDeleteBtn} from "./formFunctions";
import "../css/labels/labels.scss";

const label = document.getElementById("label");
const validationRules = {
  labelRule: {
    elem: label,
    minLength: 1,
    maxLength: label.dataset["length"],
    type: "text",
  },
};

const form = document.forms["add_label"];
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