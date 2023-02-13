/* Loader */
var Loader = {

  loader: null,
  body: null,
  html: '<span><svg width="40" height="40" version="1.1" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="15"></svg></span>',
  cssClass: "loader",
  check: function () {
    if (this.body == null) {
      this.body = document.body;
    }
  },
  open: function () {
    this.check();
    if (!this.isOpen()) {
      this.loader = document.createElement("div");
      this.loader.setAttribute("id", "loader");
      this.loader.classList.add("loader_website");
      this.loader.innerHTML = this.html;
      this.body.append(this.loader);
      this.body.classList.add(this.cssClass);
    }
    return this;
  },
  close: function () {
    this.check();
    if (this.isOpen()) {
      this.body.classList.remove(this.cssClass);
      this.loader.remove();
    }
    return this;
  },
  isOpen: function () {
    this.check();
    return this.body.classList.contains(this.cssClass);
  },
  ifOpened: function (callback, close) {
    this.check();
    if (this.isOpen()) {
      if (!!close) this.close();
      if (typeof callback === "function") {
        callback();
      }
    }
    return this;
  },
  ifClosed: function (callback, open) {
    this.check();
    if (!this.isOpen()) {
      if (!!open) this.open();
      if (typeof callback === "function") {
        callback();
      }
    }
    return this;
  },
};
/* Loader */

if (typeof module !== "undefined") {
  module.exports = Loader;
}
