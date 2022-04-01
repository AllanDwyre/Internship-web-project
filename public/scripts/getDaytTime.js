let hour = new Date().getHours();
document.getElementById("welcome-message").innerHTML =
  hour < 12 ? "Good Morning" : hour < 19 ? "Good afternoon" : "Good Evening";
