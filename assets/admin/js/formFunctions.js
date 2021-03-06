function checkForm (rules, validator) {
  let msg;
  let isValid = true;
  for (let rule in rules) {
    if ((msg = validator.validate(rules[rule])) !== true) {
      isValid = false;
      rules[rule].elem.classList.add("invalid");
      rules[rule].elem.nextElementSibling.innerText = msg;
      rules[rule].elem.scrollIntoView({
        block: "center"
      });
    }
  }
  return isValid;
}

// делает сабмит активным и неактивным для форм с чекбоксами
function toggleDeleteBtn(chkBoxes, deleteBtn) {
    let res = Array.from(chkBoxes).some((chbx) => {
      return chbx.checked;
    });
    if (res) {
      deleteBtn.disabled = false;
    } else {
      deleteBtn.disabled = true;
    }
}

export {checkForm, toggleDeleteBtn};