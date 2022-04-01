function addOffer() {
  $(".bookmark").click(function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // ---
      }
    };
    xmlhttp.open("GET", "/addOffer", true);
    xmlhttp.send();
  });
}
