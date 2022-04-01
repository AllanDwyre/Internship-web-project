<?php $title = 'InternShipp - Manage Account'; ?>
<?php $style = 'manage_account/manage_account.css'; ?>

<?php ob_start(); ?>
<!-- Content -->

<nav class="nav-sort">
  <h5>Users Account</h5>
  <div class="nav-sort-items">
    <div class="tabs">
      <?php
      if ($this->roleAuthorization(["admin", "pilot"])) {
        echo '<button class="button active">All</button>';
        if ($this->roleAuthorization(["admin"]))
          echo '<button class="button">Pilot</button>';
        echo '<button class="button">Student</button>';
        echo '<button class="button">Delegate</button>';
      }
      ?>
    </div>
    <form action=<?= $addUserRequest ?> method="post">
      <button id="add_user" class="button">Add User</button>
    </form>
  </div>

  <div class="line"></div>
</nav>
<section class="accounts-container">
  <?php
  foreach ($accounts["users"] as $value) {
    echo '<article class="account-item">
    <a href =' . $getUserRequest . $value->username . '>
      <img src="/public/assets/images/searching.png" alt="profile_img" class="profile_img">
      <div class="profile_info">
        <p class="body2 name">' . $value->firstname . ' ' . $value->lastname . '</p>
        <p class="subtitle2 role">' . $value->role . '</p>
      </div>
      <div class="profile_news">
        <div class="divider"></div>
        <button>
          <div class="circle"></div>
          <p class="button">2 new apply</p>
        </button>
      </div>
      </a>
    </article>';
  }
  ?>
</section>

<section class="compagnies_accounts">
  <div class="header">
    <h5 class="compagnies_accounts-title">Compagnies Account</h5>
    <a href=<?= $addCompanyRequest ?>>
      <p class="button">Add Company</p>
    </a>
  </div>
  <div class="compagnies-container">

    <?php
    $path = "/public/assets/images/logos/";
    $logos = array("adobe", "airbnb", "amazon", "apple", "dropbox", "google", "microsoft", "shopify", "twitter", "uber", "atlassian", "paypal");
    $colors = array('255, 0, 0', '253, 92, 99', '255, 153, 0', '153, 153, 153', '0, 97, 255', '76, 144, 245', '3, 164, 239', '80, 184, 60', '0, 132, 255', '9, 9, 26', '0, 82, 204', '37, 59, 128');
    $jobApplications = array("software enginneers", "Product designer", "Fullstack", "DevOps", "Graphist", "3D artist", "Musician");
    $location = array("Paris", "San Francisco", "Madrid", "New York City", "Moscow", "San Francisco", "London");

    for ($i = 0; $i <  count($logos); $i++) {
      $url = $path . $logos[$i] . ".png";
      $color = $colors[$i];
      echo "<article class=\"company_item\" style=\"background-image: url($url); background-color: rgb($color);\"></article>";
    }
    ?>
  </div>
</section>


<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->
<script>
  $(".tabs").children().click(function() {
    tab = $(this).text();
    tabsDisplay(tab)
    $(".tabs").children().removeClass("active");
    $(this).addClass("active");
  })


  function tabsDisplay(tab) {
    let cardlist = $(".account-item").toArray();
    if (tab == "All") {
      cardlist.forEach(element => {
        element.style.display = "flex";
      })
      return;
    }
    cardlist.forEach(element => {
      let roleInput = element.getElementsByClassName("role")[0].innerHTML

      if (roleInput.toLowerCase() != tab.toLowerCase()) {
        element.style.display = "none";
      } else {
        element.style.display = "flex";

      }
    })


  }
</script>
<script src="Scripts/animations.js"></script>
<script src="Scripts/getDaytTime.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>


<?php require('mainPage_template.php'); ?>