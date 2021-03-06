export default {
  checkLength(rules) {
    let trimmedVal = rules.elem.value.trim();
    if (rules.type === "phone") {
      trimmedVal = trimmedVal.split(" ").join("");
    }
    rules.elem.value = trimmedVal;
    this.length = trimmedVal.length;
    return this.length >= rules.minLength && this.length <= rules.maxLength;
  },

  checkUrl(rules) {
    let regex = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;

    return regex.test(rules.elem.value.trim()) ? true : "Невалидная ссылка";
  },

  checkImage(rules) {
    let files = rules.elem.files;
    if (!files.length) return "Необходимо добавить хотя бы одно изображение";

    // проверка расширения загруженных файлов
    let isValidExt = Array.from(files).every((file) => {
      return /image\/((jpe?g)|(png))/i.test(file.type);
    });

    if (!isValidExt) return "Ваши картинки - не картинки";

    return true;
  },

  checkPhone(rules) {
    let regex = /^(8|\+7)\d{10}$/;

    return regex.test(rules.elem.value.trim())
      ? true
      : "Невалидный номер (пример: +79991112255)";
  },

  checkEmail(rules) {
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    return regex.test(rules.elem.value.trim()) ? true : "Невалидный email";
  },

  // возвращает либо true, либо строку с сообщением
  validate(rules) {
    if (rules.type === "images") return this.checkImage(rules);

    if (!this.checkLength(rules)) {
      return `Длина должна быть от ${rules.minLength} до ${rules.maxLength} символов`;
    }

    if (rules.type === "url" && this.length > 0) return this.checkUrl(rules);
    if (rules.type === "phone" && this.length > 0) return this.checkPhone(rules);
    if (rules.type === "email" && this.length > 0) return this.checkEmail(rules);

    return true;
  },
};
