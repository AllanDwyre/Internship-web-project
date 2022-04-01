let registrationToggle = false;

$(document).ready(function () {
  fade();
  toggleRegistrationMode();
  dropdown();
  OpenDiaglog();
});

function OpenDiaglog() {
  $(".category-contents-item-container").click(function () {
    document.querySelector("dialog").showModal();
  });
}
function dropdown() {
  $(".category-title").click(function () {
    alert("Please select");
    // if ($(this).find("span").css("transform") == "none") {
    //   $(this).find("span").css("transform", "rotate(-90deg)");
    // } else {
    //   $(this).find("span").css("transform", "none");
    // }
    $(this).parent().find(".category-contents").slideToggle();
  });
}
function toggleRegistrationMode() {
  $(".registration-toggle").click(function () {
    if (window.screen.width > 768) {
      // Mode PC
      $(".split-right").animate({ opacity: registrationToggle ? "1" : "0" });
      $(".split-left").animate({ opacity: registrationToggle ? "0" : "1" });
      $("#image")
        .animate(
          {
            right: registrationToggle ? "50vw" : "0vw",
          },
          {
            duration: 100,
          }
        )
        .attr(
          "src",
          registrationToggle
            ? "https://images.unsplash.com/photo-1535957998253-26ae1ef29506?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=736&q=80"
            : "https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
        );
    } else {
      // Mobile / tablet
      $(".split-right")
        .animate({ opacity: registrationToggle ? "1" : "0" })
        .css("display", registrationToggle ? "flex" : "none");
      $(".split-left")
        .animate({ opacity: registrationToggle ? "0" : "1" })
        .css("display", registrationToggle ? "none" : "flex");
      $("#image").attr(
        "src",
        registrationToggle
          ? "https://images.unsplash.com/photo-1535957998253-26ae1ef29506?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=736&q=80"
          : "https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
      );
    }
    registrationToggle = !registrationToggle;
  });
}
function fade() {
  $(".fadeIn").animate(
    {
      opacity: "1",
    },
    2000
  );
}
