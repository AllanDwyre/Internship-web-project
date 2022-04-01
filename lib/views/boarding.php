<!-- https://imjignesh.com/css-only-parallax/ -->
<!-- https://cofolios.com/ -->
<?php $title = 'InternShipp'; ?>
<?php $style = 'boarding/boarding.css'; ?>
<?php ob_start(); ?>
<!-- Content -->
<nav>
  <div class="nav-items">
    <div class="shortcuts">
      <a href="#header">
        <p class="body1">Home</p>
        <div class="line"></div>
      </a>
      <a href="#about">
        <p class="body1">About Us</p>
        <div class="line"></div>
      </a>
      <a href="#compagnies">
        <p class="body1">Companies</p>
        <div class="line"></div>
      </a>
    </div>
    <a href="registration">
      <p class="body1">Join Us</p>
      <div class="line"></div>
    </a>
  </div>
</nav>
<section id="header" class="header" name="header">
  <div class="split_left">
    <div class="header-title">
      <p class="body1">Hola Welcome 👋,</p>
      <h1>Intershipp</h1>
    </div>
    <div class="article-cards">
      <a target="_blank" href="https://medium.com/@danielrevelinoarsono/can-we-make-a-good-cv-in-instant-4f6dfa75a908">
        <article>
          <p class="subtitle2">Can We Make A Good CV in Instant?</p>
          <p class="subtitle2">Daniel Revelino</p>
        </article>
      </a>
      <a target="_blank" href="https://medium.com/free-code-camp/how-doing-something-i-love-landed-me-a-top-tier-tech-internship-fe78d8b74e48">
        <article>
          <p class="subtitle2">I landed in a internship by doing something I love</p>
          <p class="subtitle2">Taylor Milliman</p>
        </article>
      </a>
    </div>
  </div>
  <div class="split_right">
    <aside>
      <div>
        <p class="heading6">95%</p>
        <p class="subtitle2">Success Rate</p>
      </div>
      <div>
        <p class="heading6">+5000</p>
        <p class="subtitle2">Students Registers</p>
      </div>
      <div>
        <p class="heading6">+800</p>
        <p class="subtitle2">Companies Engaged</p>
      </div>
    </aside>
  </div>
  <a href="#about"><span class="material-icons arrow_down">
      keyboard_double_arrow_down
    </span></a>
</section>
<section id="about" class="about_us">
  <div class="about_us-title">
    <p class="overline">Who are we</p>
    <h6>About Us</h6>
  </div>
  <section class="about_us-staff">
    <div id="firstImage" class="about_us-staff-image">
      <img draggable="false" src="https://images.unsplash.com/photo-1622151834677-70f982c9adef?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGJ1c2luZXNzJTIwbWFufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="" />
      <p class="overline">Devops</p>
      <h6>Allan Golding Dwyre</h6>
    </div>
    <div class="about_us-staff-image">
      <img draggable="false" src="https://images.unsplash.com/photo-1582015752624-e8b1c75e3711?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGJ1c2luZXNzJTIwbWFufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="" />
      <p class="overline">Data Scientist</p>
      <h6>Andrew Hiver</h6>
    </div>
    <div class="about_us-staff-image">
      <img draggable="false" src="https://media.istockphoto.com/photos/woman-working-on-a-laptop-in-a-modern-workspace-picture-id1354221572?b=1&k=20&m=1354221572&s=170667a&w=0&h=2eAO_T4nzBajXSyPLigwP5VzQ0tifPQFt9TGXmBAOec=" alt="" />
      <p class="overline">Fullstack</p>
      <h6>Guillem Pairot</h6>
    </div>
  </section>
  <section class="about_us-info">
    <div class="about_us-title">
      <p class="overline">What we propose</p>
      <h6>About Us</h6>
    </div>
    <div class="about_us-info-cards">
      <div class="about_us-info-card">
        <img src="" alt="" />
        <p class="body1">Find your intership</p>
        <p class="caption">
          We can help you to find in the easiest way a company.
        </p>
      </div>
      <div class="about_us-info-card">
        <img src="" alt="" />
        <p class="body1">Organise</p>
        <p class="caption">
          We provide you services to follow the offers you apply, and compare
          each of them to find the right one.
        </p>
      </div>
      <div class="about_us-info-card">
        <img src="" alt="" />
        <p class="body1">Community</p>
        <p class="caption">
          We expand our relation to add more and more companies and
          possibility for you
        </p>
      </div>
    </div>
  </section>

</section>
<section id="compagnies" class="companies">
  <h6>Companies </h6>
  <div class="center-companies">
    <div class=" companies-grid">
      <?php
      $path = "public/assets/images/logos/";
      $logos = array("adobe", "airbnb", "amazon", "apple", "dropbox", "google", "microsoft", "shopify", "twitter", "uber", "atlassian", "paypal");
      $colors = array('255, 0, 0', '253, 92, 99', '255, 153, 0', '153, 153, 153', '0, 97, 255', '76, 144, 245', '3, 164, 239', '80, 184, 60', '0, 132, 255', '9, 9, 26', '0, 82, 204', '37, 59, 128');
      for ($i = 0; $i <  count($logos); $i++) {
        $url = $path . $logos[$i] . ".png";
        $color = $colors[$i];
        echo '<button class="companies-card" >';
        echo '<div class="flip-card-inner">';
        echo "<div class=\"flip-card-front\" style=\"background-image: url($url); background-color: rgb($color);\">";
        // content
        echo '</div>';
        echo "<div class=\"flip-card-back\" style=\"background-color: rgb($color);\">";
        // content
        echo  '<h5>' . $logos[$i] . '</h5>';
        echo '</div>';
        echo '</div>';
        echo '</button>';
      }
      ?>
    </div>
  </div>
</section>
<section id="join" class="join-us">
  <h4></h4>
  <div class="join_button">
    <a href="registration">
      <div>
        <p class="body1">Get Started</p>
        <span class="material-icons">arrow_forward</span>
      </div>
      <div class="line"></div>

    </a>
  </div>
</section>
<footer>
  <div class="left">
    <h6>InternShipp</h6>
    <p class="caption">Helping connect the intern community. Built by <span> Allan</span>, <span>Andrew</span> and <span>Guillem</span></p>
  </div>
  <div class="right">
    <h6>Links</h6>
    <div class="links">
      <a href="#header">
        <p class="caption">Home</p>
        <div class="line"></div>
      </a>
      <a href="#about">
        <p class="caption">About Us</p>
        <div class="line"></div>
      </a>
      <a href="#compagnies">
        <p class="caption">Companies</p>
        <div class="line"></div>
      </a>
      <a href="registration">
        <p class="caption">Join Us</p>
        <div class="line"></div>
      </a>
    </div>
  </div>
</footer>


<script src="./public/Scripts/animations.js"></script>
<script src="./public/Scripts/boardingAnimation.js"></script>

<!-- Content -->
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>