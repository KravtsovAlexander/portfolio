import validator from "./Validator.js";
import {checkForm} from "./formFunctions";
import "../css/contacts/contacts.scss";

const phone = document.getElementById("phone"),
  email = document.getElementById("email"),
  vk = document.getElementById("vk"),
  instagram = document.getElementById("instagram"),
  telegram = document.getElementById("telegram");

const validationRules = {
  phoneRules: {
    elem: phone,
    minLength: 0,
    maxLength: phone.dataset["length"],
    type: "phone",
  },
  emailRules: {
    elem: email,
    minLength: 0,
    maxLength: email.dataset["length"],
    type: "email",
  },
  vkRules: {
    elem: vk,
    minLength: 0,
    maxLength: vk.dataset["length"],
    type: "url",
  },
  instagramRules: {
    elem: instagram,
    minLength: 0,
    maxLength: instagram.dataset["length"],
    type: "url",
  },
  telegramRules: {
    elem: telegram,
    minLength: 0,
    maxLength: telegram.dataset["length"],
    type: "url",
  }
};

Object.values(validationRules).forEach((rule) => {
  rule.elem.addEventListener("focus", () => {
    rule.elem.classList.remove("invalid");
    rule.elem.nextElementSibling.innerText = "";
  });
});

const form = document.forms["contacts_form"];
form.addEventListener("submit", (event) => {
  event.preventDefault();
  if (checkForm(validationRules, validator)) {
    form.submit();
  }
});