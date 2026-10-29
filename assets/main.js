(function () {
  var b = document.querySelector(".menu-btn"),
    n = document.getElementById("nav");
  if (b) {
    b.addEventListener("click", function () {
      var o = n.classList.toggle("open");
      b.setAttribute("aria-expanded", o);
    });
  }
  var y = document.getElementById("yr");
  if (y) y.textContent = new Date().getFullYear();
  var f = document.getElementById("enq");
  if (f) {
    if (location.search.indexOf("sent=1") > -1) {
      document.getElementById("sent").classList.add("show");
    }
    document.getElementById("wa-send").addEventListener("click", function () {
      if (!f.reportValidity()) return;
      var d = new FormData(f);
      var t =
        "Enquiry from the website\nName: " +
        d.get("name") +
        "\nCompany: " +
        (d.get("company") || "-") +
        "\nPhone: " +
        (d.get("phone") || "-") +
        "\nTopic: " +
        d.get("topic") +
        "\nMessage: " +
        d.get("message");
      window.open(
        "https://wa.me/27815058527?text=" + encodeURIComponent(t),
        "_blank",
        "noopener",
      );
    });
  }
})();
