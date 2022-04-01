$(document).ready(function () {
  console.log(window.screen.width);
  if (window.screen.width > 768) {
    imageAnimation();
  }
});

function imageAnimation() {
  let currentObject = $("#firstImage");
  currentObject.css({ width: "500px" });
  let currentText = currentObject.find("p");
  currentText.css({ opacity: "1" });

  $(".about_us-staff")
    .children()
    .hover(function () {
      currentObject.css({ width: "50px" });
      currentText.animate({ opacity: "0" });
      currentObject = $(this);
      currentText = currentObject.find("p");
      currentObject.css({ width: "500px" });
      currentText.animate({ opacity: "1" });
    });
}

let anchorlinks = document.querySelectorAll('a[href^="#"]');

for (let item of anchorlinks) {
  // relitere
  item.addEventListener("click", (e) => {
    let hashval = item.getAttribute("href");
    let target = document.querySelector(hashval);
    target.scrollIntoView({
      behavior: "smooth",
    });
    history.pushState(null, null, hashval);
    e.preventDefault();
  });
}
