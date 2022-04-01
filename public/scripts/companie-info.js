$(document).ready(function () {
  imageAnimation();
  wishList();
});

function wishList() {
  $(".category-contents-item")
    .find("button")
    .click(function () {
      if ($(this).html() == "bookmark_border") {
        $(this).html("bookmark");
      } else {
        $(this).html("bookmark_border");
      }
    });
}

function imageAnimation() {
  let currentImage = $("#firstImage").css({ width: "100%", opacity: "1" });

  $(".image")
    .children()
    .hover(function () {
      currentImage.css({ width: "10%", opacity: ".7" });
      currentImage = $(this);
      currentImage.css({ width: "100%", opacity: "1" });
    });
}
