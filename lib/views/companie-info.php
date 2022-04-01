<?php $title = 'InternShipp - ' . $companyInfo->business_name; ?>
<?php $style = 'companie-info/companie-info.css'; ?>

<?php ob_start(); ?>

<article class="company-header">
  <header class="company-header-title">
    <h3><?= $companyInfo->business_name ?></h3>
    <div class="reputation">
      <span class="material-icons"><?= $companyInfo->Trainee_mark ?></span>
    </div>
    <p class="button">Evaluate this company</p>
    <?php
    if ($this->roleAuthorization(["admin", "pilot"])) {
      echo "<a id='modify_company'href=" . $modifyCompanyRequest . "><p class='button'>Modify this company</p></a>";
      echo "<a id='delete_company'href=" . $deleteCompanyRequest . "><p class='button'>Delete this company</p></a>";
    }
    ?>
  </header>
  <div class="company-header-about">
    <h5>About</h5>
    <p class="body1">FIRST ORBITAL CLASS ROCKET CAPABLE OF REFLIGHT</p>
    <div class="image">
      <img id="firstImage" src="https://images.unsplash.com/photo-1457364887197-9150188c107b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" />
      <img src="https://images.unsplash.com/photo-1457364983758-510f8afa9f5f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" />
      <img src="https://images.unsplash.com/photo-1465788786008-f75a725b34e9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" />
    </div>
  </div>
</article>

<section class="company-info">
  <h5>Information</h5>
  <div class="company-info-content">

    <div class="company-info-content-line">
      <p>Activity Sector:</p>
      <p><?= $companyInfo->Activity_sector ?></p>
    </div>
    <div class="company-info-content-line">
      <p>Location :</p>
      <p> <?= $companyInfo->Locality ?></p>
    </div>
    <div class="company-info-content-line">
      <p>Intern evaluation : </p>
      <span class="material-icons"><?= $companyInfo->Trainee_mark ?></span>
    </div>
    <div class="company-info-content-line">
      <p class="body1">Intern number :</p>
      <p> <?= $companyInfo->Number_Cesi_trainees ?></p>
    </div>
    <div class="company-info-content-line">
      <p class="body1">Pilot Trust :</p>
      <span class="material-icons"><?= $companyInfo->Pilot_trust ?></span>
    </div>

  </div>
</section>

<section class="company-offers">
  <h5>Company offers</h5>
  <p class="subtitle2">The offers board where new opportunities are posted. Updated frequently.</p>
  <div class="split">
    <div class="split-left">
      <img src="/public/assets/images/job_offers.png" alt="job_offer">
    </div>
    <div class="split-right">
      <article class='offer-item'>
        <div class='offer-item-content'>
          <div class='offer-information'>
            <p class='body1'> Skills </p>
          </div>
          <p class='body1'> Localicy </p>
          <p class='body1'>Duration </p>
          <p class='body1'> Remuneration per month </p>
        </div>
        <div class='separationLine'></div>
      </article>
      <?php
      foreach ($companyInfo->offers as $value) {
        echo "<article class='offer-item'>";
        echo " <div class='offer-item-content'>";
        echo " <div class='offer-information'>";
        echo "    <p class='body1'>" . $value["skills"] . "</p>";
        echo " </div>";
        echo " <p class='body1'>" . $value["localicy"] . "</p>";
        echo " <p class='body1'>" . $value["duration"] . "</p>";
        echo " <p class='body1'>" . (int) $value["remuneration"] . ' $ per month' . "</p>";
        if (!$this->roleAuthorization(["admin", "pilot", "delegate"])) {
          echo " <div class='offer-actions'>";
          echo '<a href=' . $openOfferRequest . $value["id_offer"] . '><span class="material-icons-outlined open">open_in_new</span></a>';
          echo '<a href=' . $value["requestOnBookmarkClick"] . '><span class="material-icons-outlined bookmark">' . $value["isInWishlist"] . '</span></a>';
          echo " </div>";
        }
        if ($this->roleAuthorization(["admin", "pilot"])) {
          echo " <div class='offer-actions'>";
          echo '<a href=' . $modifyOfferRequest . '&' . $value["id_offer"] . '><span class="material-icons-outlined open">edit </span></a>';
          echo '<a href=' . $deleteOfferRequest . '&' . $value["id_offer"] . '><span class="material-icons-outlined delete">delete </span></a>';
          echo " </div>";
        }
        echo "</div>";
        echo "<div class='separationLine'></div>";
        echo "</article>";
      }
      if ($this->roleAuthorization(["admin", "pilot", "delegate"])) {

        echo "<div class='addOffer_container'>";
        echo " <a id='add_offer' href=" . $addOfferRequest . "><p class='button'>Add Offer</p></a>";
        echo "</div>";
      }

      ?>
    </div>
  </div>
</section>
<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->
<script src="/public/Scripts/wishlist_Ajax.js"></script>
<script src="/public/Scripts/companie-info.js"></script>

<script src="/public/Scripts/animations.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>


<?php require('mainPage_template.php'); ?>