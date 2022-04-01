function emailValidation() {
  let email = document.forms["signUpForm"]["femail"].value;
  const emailCriteria = document.getElementById("email_criteria").style;

  let regexEmail = /^[a-zA-Z0-9.]+@[a-zA-Z0-9]+\.[a-zA-Z]/;
  if (regexEmail.test(email)) {
    emailCriteria.background = "#00cc66";
    emailCriteria.border = "none";
    return true;
  } else {
    emailCriteria.background = "#212121";
    emailCriteria.border = "1px solid #2c2c2c";
    return false;
  }
}

function passwordValidation() {
  let password = document.forms["signUpForm"]["fpassword"].value;

  const passwordCriteria = document.getElementById("password_criteria").style;

  let regexPass = /\d/;

  if (password.length >= 6 && regexPass.test(password)) {
    passwordCriteria.background = "#00cc66";
    passwordCriteria.border = "none";
    return true;
  } else {
    passwordCriteria.background = "#212121";
    passwordCriteria.border = "1px solid #2c2c2c";
    return false;
  }
}
