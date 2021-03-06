import validator from "./Validator.js";
import {checkForm} from "./formFunctions.js";
import "../css/projects/add_project.scss";

const title = document.getElementById("title"),
  appstoreLink = document.getElementById("appstore_link"),
  googleplayLink = document.getElementById("googleplay_link"),
  webVesionLink = document.getElementById("web_version_link"),
  images = document.getElementById("images");

const validationRules = {
  titleRules: {
    elem: title,
    minLength: 1,
    maxLength: title.dataset["length"],
    type: "text",
  },
  appstoreLinkRules: {
    elem: appstoreLink,
    minLength: 0,
    maxLength: appstoreLink.dataset["length"],
    type: "url",
  },
  googleplayLinkRules: {
    elem: googleplayLink,
    minLength: 0,
    maxLength: googleplayLink.dataset["length"],
    type: "url",
  },
  webVersionLinkRules: {
    elem: webVesionLink,
    minLength: 0,
    maxLength: webVesionLink.dataset["length"],
    type: "url",
  },
  imagesRules: {
    elem: images,
    type: "images"
  }
};

// снятие подсветки при фокусе инпута
Object.values(validationRules).forEach((rule) => {
  rule.elem.addEventListener("focus", () => {
    rule.elem.classList.remove("invalid");
    rule.elem.nextElementSibling.innerText = "";
  });
});

const form = document.querySelector("form");

form.addEventListener("submit", async (event) => {
  event.preventDefault();

  if (checkForm(validationRules, validator)) {
    let data = new FormData(form);

    const response = await fetch("/admin/dashboard/projects/add-project", {
      method: "POST",
      body: data,
    });

    const answer = await response;
    const msg = await response.text();
    showMsg(answer, msg);
  }
});

function showMsg(answer, msg) {
  if (answer.status === 200) {
    document.getElementById("form-message").innerText =
      "Проект успешно добавлен!";
    form.reset();
  } else {
    document.getElementById("form-message").innerText =
      "Проект не был добавлен! (сообщение отправлено в консоль)";
    console.log(msg);
  }
}
