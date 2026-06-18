(function () {
  "use strict";

  function getField(form, names) {
    var list = Array.isArray(names) ? names : [names];
    for (var i = 0; i < list.length; i += 1) {
      var field = form.querySelector('[name="' + list[i] + '"]');
      if (field) {
        return field;
      }
    }
    return null;
  }

  function fieldAnchor(field) {
    return field.closest(".input-group") || field;
  }

  function clearFieldError(field) {
    if (!field) {
      return;
    }
    field.classList.remove("is-invalid");
    field.removeAttribute("aria-invalid");
    var anchor = fieldAnchor(field);
    var next = anchor.nextElementSibling;
    if (next && next.classList.contains("caaft-field-error")) {
      next.remove();
    }
    var parent = field.closest(".col-lg-12, .col-lg-6, .col-md-6");
    if (parent) {
      var err = parent.querySelector(":scope > .caaft-field-error");
      if (err) {
        err.remove();
      }
    }
  }

  function clearFormErrors(form) {
    form.querySelectorAll(".caaft-field-error").forEach(function (node) {
      node.remove();
    });
    form.querySelectorAll(".is-invalid").forEach(function (node) {
      node.classList.remove("is-invalid");
      node.removeAttribute("aria-invalid");
    });
    form.querySelectorAll(".g-recaptcha.caaft-is-invalid").forEach(function (node) {
      node.classList.remove("caaft-is-invalid");
    });
    var summary = form.querySelector(".caaft-form-errors");
    if (summary) {
      summary.textContent = "";
      summary.hidden = true;
    }
  }

  function showFieldError(field, message) {
    clearFieldError(field);
    field.classList.add("is-invalid");
    field.setAttribute("aria-invalid", "true");

    var err = document.createElement("p");
    err.className = "caaft-field-error";
    err.setAttribute("role", "alert");
    err.textContent = message;

    var anchor = fieldAnchor(field);
    var col = field.closest(".col-lg-12, .col-lg-6, .col-md-6");
    if (col && col.contains(anchor)) {
      col.appendChild(err);
    } else {
      anchor.insertAdjacentElement("afterend", err);
    }
  }

  function showRecaptchaError(form, message) {
    var widget = form.querySelector(".g-recaptcha");
    if (!widget) {
      return;
    }
    widget.classList.add("caaft-is-invalid");
    var wrap = widget.closest(".col-lg-12") || widget.parentElement;
    var existing = wrap.querySelector(":scope > .caaft-field-error");
    if (existing) {
      existing.textContent = message;
      return;
    }
    var err = document.createElement("p");
    err.className = "caaft-field-error";
    err.setAttribute("role", "alert");
    err.textContent = message;
    widget.insertAdjacentElement("afterend", err);
  }

  function isEmptySelect(field) {
    return !field.value || field.value === "";
  }

  function validateForm(form) {
    clearFormErrors(form);
    var errors = [];

    function addError(field, message) {
      if (!field) {
        return;
      }
      errors.push({ field: field, message: message });
    }

    var honeypot = getField(form, ["firstname"]);
    if (honeypot && honeypot.value.trim() !== "") {
      addError(getField(form, ["name", "email"]) || honeypot, "Unable to submit this form. Please try again.");
      return errors;
    }

    var name = getField(form, ["name"]);
    if (name && name.value.trim() === "") {
      addError(name, "Please enter your name.");
    }

    var email = getField(form, ["email"]);
    if (email) {
      var emailValue = email.value.trim();
      if (emailValue === "") {
        addError(email, "Please enter your email address.");
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
        addError(email, "Please enter a valid email address.");
      }
    }

    var phone = getField(form, ["phone"]);
    if (phone) {
      var phoneValue = phone.value.trim();
      if (phoneValue === "") {
        addError(phone, "Please enter your phone number.");
      } else if (!/^[0-9]{10}$/.test(phoneValue)) {
        addError(phone, "Please enter a valid 10-digit phone number.");
      }
    }

    var service = getField(form, ["service"]);
    if (service && isEmptySelect(service)) {
      addError(service, "Please choose a service.");
    }

    var aboutSelect = form.querySelector('#about, select[name="about"]');
    var otherAbout = form.querySelector("#other-text");
    if (aboutSelect && aboutSelect.name === "about") {
      if (isEmptySelect(aboutSelect)) {
        addError(aboutSelect, "Please select how you heard about us.");
      }
    } else if (otherAbout && otherAbout.offsetParent !== null) {
      if (otherAbout.value.trim() === "") {
        addError(otherAbout, "Please mention how you heard about us.");
      }
    }

    var message = getField(form, ["msg", "message"]);
    if (message && message.value.trim() !== "" && !/^[\x00-\x7F]+$/.test(message.value)) {
      addError(message, "Please enter a valid message.");
    }

    if (typeof window.grecaptcha !== "undefined" && form.querySelector(".g-recaptcha")) {
      var recaptchaResponse = window.grecaptcha.getResponse();
      if (!recaptchaResponse || recaptchaResponse.length === 0) {
        errors.push({ field: null, message: "Please verify that you are not a robot.", recaptcha: true });
      }
    }

    return errors;
  }

  function displayErrors(form, errors) {
    errors.forEach(function (item) {
      if (item.recaptcha) {
        showRecaptchaError(form, item.message);
        return;
      }
      showFieldError(item.field, item.message);
    });

    if (errors.length > 0) {
      var first = errors[0].field;
      if (first) {
        first.focus({ preventScroll: true });
        first.scrollIntoView({ behavior: "smooth", block: "center" });
      } else if (errors[0].recaptcha) {
        var widget = form.querySelector(".g-recaptcha");
        if (widget) {
          widget.scrollIntoView({ behavior: "smooth", block: "center" });
        }
      }
    }
  }

  function validateAndShow(form) {
    var errors = validateForm(form);
    if (errors.length > 0) {
      displayErrors(form, errors);
      return false;
    }
    return true;
  }

  function bindForm(form) {
    if (form.dataset.caaftValidateBound === "1") {
      return;
    }
    form.dataset.caaftValidateBound = "1";

    form.addEventListener("input", function (event) {
      if (event.target.matches("input, textarea, select")) {
        if (event.target.name === "phone" || event.target.id === "phone") {
          event.target.value = event.target.value.replace(/[^0-9]/g, "");
        }
        clearFieldError(event.target);
      }
    });

    form.addEventListener("change", function (event) {
      if (event.target.matches("input, textarea, select")) {
        clearFieldError(event.target);
      }
      if (event.target.matches(".g-recaptcha *")) {
        clearFormErrors(form);
      }
    });

    form.addEventListener("submit", function (event) {
      if (form.dataset.caaftAllowSubmit === "1") {
        form.dataset.caaftAllowSubmit = "0";
        return;
      }

      event.preventDefault();
      event.stopPropagation();

      if (!validateAndShow(form)) {
        return;
      }

      form.dataset.caaftAllowSubmit = "1";
      HTMLFormElement.prototype.submit.call(form);
    });
  }

  function initAboutToggle() {
    var aboutSelect = document.getElementById("about");
    var otherInputGroup = document.getElementById("other-input");
    var otherText = document.getElementById("other-text");
    if (!aboutSelect || !otherInputGroup || !otherText) {
      return;
    }

    var form = aboutSelect.closest("form");

    aboutSelect.addEventListener("change", function () {
      if (aboutSelect.value === "Others") {
        otherInputGroup.style.display = "flex";
        if (form && form.id === "contact-form") {
          otherText.setAttribute("name", "about_other");
        } else {
          otherText.setAttribute("name", "about");
          aboutSelect.removeAttribute("name");
        }
      } else {
        otherInputGroup.style.display = "none";
        otherText.removeAttribute("name");
        otherText.value = "";
        aboutSelect.setAttribute("name", "about");
        clearFieldError(otherText);
      }
      clearFieldError(aboutSelect);
    });
  }

  function init() {
    document.querySelectorAll("form.contact").forEach(bindForm);
    initAboutToggle();
  }

  window.CaaftFormValidate = validateAndShow;

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
