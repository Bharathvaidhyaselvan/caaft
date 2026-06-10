/**
 * Attach the current page URL to all mail form submissions.
 */
(function () {
  "use strict";

  function currentPageUrl() {
    return window.location.href.split("#")[0];
  }

  function isMailForm(form) {
    var action = (form.getAttribute("action") || "").toLowerCase();
    return action !== "" && action !== "#" && action.indexOf("mail") !== -1;
  }

  function ensurePageUrlField(form) {
    if (!isMailForm(form)) {
      return;
    }

    var field = form.querySelector('input[name="page_url"]');
    if (!field) {
      field = document.createElement("input");
      field.type = "hidden";
      field.name = "page_url";
      form.appendChild(field);
    }

    field.value = currentPageUrl();
  }

  document.addEventListener(
    "submit",
    function (e) {
      var form = e.target;
      if (!form || form.tagName !== "FORM") {
        return;
      }
      ensurePageUrlField(form);
    },
    true,
  );

  function initForms() {
    document.querySelectorAll("form").forEach(ensurePageUrlField);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initForms);
  } else {
    initForms();
  }
})();
