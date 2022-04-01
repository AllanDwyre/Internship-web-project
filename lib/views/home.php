<?php $title = 'InternShipp - Feed'; ?>
<?php $style = 'home/home.css'; ?>

<?php ob_start(); ?>
<!-- Content -->

<p> <span id="welcome-message">Good Morning</span> <?= $_SESSION["firstname"] ?> 👋</p>
<section class="tips">
    <!-- This Section will contain tips for user to have a better User Experience -->
</section>
<section class="Offers">
    <h5>Current applied offers</h5>
    <p class="subtitle2">Your can keep a track at the offers your applied.</p>
    <div class="myOffer-List">
        <?php
        $path = "public/assets/images/logos/";
        $logos = array("adobe", "airbnb", "amazon", "apple", "dropbox", "google", "microsoft", "shopify", "twitter", "uber", "atlassian", "paypal");
        $colors = array('255, 0, 0', '253, 92, 99', '255, 153, 0', '153, 153, 153', '0, 97, 255', '76, 144, 245', '3, 164, 239', '80, 184, 60', '0, 132, 255', '9, 9, 26', '0, 82, 204', '37, 59, 128');
        $jobApplications = array("software enginneers", "Product designer", "Fullstack", "DevOps", "Graphist", "3D artist", "Musician");
        $location = array("Paris", "San Francisco", "Madrid", "New York City", "Moscow", "San Francisco", "London");

        for ($i = 0; $i <  count($logos); $i++) {
            $url = $path . $logos[$i] . ".png";
            $color = $colors[$i];
            echo '<button class="myOffer-item" >';
            echo '<div class="flip-card-inner">';
            echo "<div class=\"flip-card-front\" style=\"background-image: url($url); background-color: rgb($color);\">";
            // content
            echo '</div>';
            echo "<div class=\"flip-card-back\" style=\"background-color: rgb($color);\">";
            // content
            echo  '<h5>' . $logos[$i] . '</h5>';
            echo  '<p>' . $jobApplications[$i % count($jobApplications)] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</button>';
        }
        ?>
    </div>
</section>
<section class="newOffers">
    <h5>New Offers</h5>
    <p class="subtitle2">The offers board where new grad and intern jobs are posted. Updated frequently.</p>
    <div class="split">
        <div class="split-left">
            <?php
            for ($i = 0; $i < 5; $i++) {
                $url = $path . $logos[$i] . ".png";
                $color = $colors[$i];
                echo "<article class='newOffers-item'>";
                echo " <div class='newOffers-item-content'>";
                echo " <div class='logo-img' style=\"background-image: url($url); background-color: rgb($color);\"></div>";
                echo " <div class='offer-information'>";
                echo "    <p class='body1'>" . $logos[$i] . "</p>";
                echo "    <p class='body1'>" . $jobApplications[$i % count($jobApplications)] . "</p>";
                echo " </div>";
                echo " <p class='body1'>" . $location[$i] . "</p>";
                echo "</div>";
                echo "<div class='separationLine'></div>";
                echo "</article>";
            }
            ?>
        </div>
        <article class="split-right">
            <img draggable="false" src="public/assets/images/searching.png" alt="right-img">
        </article>
    </div>
</section>
<section class="stats">
    <h5>Statistics</h5>
    <p class="subtitle2">You can sort all yours offers to find the best internship</p>
    <!-- make a responsive table -->
    <div class="table">

    </div>
</section>





<!-- Content -->
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<!-- Script -->
<script>
    $(".myOffer-item")
</script>
<script src="public/Scripts/animations.js"></script>
<script src="public/Scripts/getDaytTime.js"></script>

<!-- Script -->
<?php $scripts = ob_get_clean(); ?>

<?php require('mainPage_template.php'); ?>