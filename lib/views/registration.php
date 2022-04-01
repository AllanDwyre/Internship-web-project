<!-- https://web.dev/sign-in-form-best-practices/ -->
<!-- https://web.dev/identity/ -->
<!-- https://www.studentstutorial.com/php/mvc/forgot-password.php -->
<?php

$title = 'InternShipp - Registration';
$style = 'registration/registration.css';

ob_start(); ?>
<!-- Content -->

<img draggable="false" id="image" class="registration-toggle" src="https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="login image" />
<section class="split fadeIn">
  <article class="split-left">
    <header>
      <h3>Let’s sign you in.</h3>
      <h5>Welcome back. You’ve been missed!</h5>
    </header>
    <form action="/registration/login" method="post">
      <input type="text" placeholder="Username" name="fusername" />
      <input type="password" placeholder="Password" name="fpassword" />
      <a href="">
        <p class="button">Forgot your password?</p>
      </a>
      <button type="submit"><span>Sign In</span></button>
    </form>
    <p class="registration-toggle body1">
      Dont Have an account? <span>Sign Up</span>
    </p>
  </article>
  <article class="split-right">
    <header>
      <h3>Create a New Account.</h3>
      <h5>Ask to your pilot to accept your new account</h5>
    </header>
    <form name="signUpForm" action="">
      <input oninput="emailValidation()" type="text" placeholder="Pilot Name" name="fpilot" />
      <input oninput="emailValidation()" type="email" placeholder="Email" name="femail" />
      <input oninput="passwordValidation()" type="password" placeholder="Password" name="fpassword" />
      <div class="criteria">
        <div id="email_criteria" class="circle"></div>
        <p class="body1">Email must be valid.</p>
      </div>
      <div class="criteria">
        <div id="password_criteria" class="circle"></div>
        <p class="body1">
          Password must have at least 6 charaters and 1 number.
        </p>
      </div>
      <button type="submit"><span>Create an account</span></button>
    </form>
    <p class="registration-toggle body1">
      Already have an account? <span>Sign In</span>
    </p>
  </article>
</section>

<script src="/public/Scripts/animations.js"></script>
<script src="/public/Scripts/registrationForm.js"></script>


<!-- Content -->
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>