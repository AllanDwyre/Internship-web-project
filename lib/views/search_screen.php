<?php $title = 'InternShipp - Search'; ?>
<?php $style = 'search_screen/search.css'; ?>

<?php ob_start(); ?>
<!-- Content -->
<div class="split">
    <div class="left">
        <h5>Choose the most suitable internship</h5>
        <p class="subtitle2">Add filters to find your perfect intternship</p>
    </div>

    <form action="" method="post">
        <!-- FILTRES -->
        <h5>Browse</h5>
        <div class="search_container">
            <span class="material-icons-outlined">
                search
            </span>
            <div class="separator_line"></div>
            <input type="search" name="search_input" id="search_input" placeholder="Search students, compagnies or offers" value=<?= $searchInput ?? "" ?>>
            <button type="submit">
                <span class="material-icons-outlined ">
                    east
                </span>
            </button>
        </div>

    </form>
</div>
<section class="results_container">
    <h5>Results</h5>

    <p class="subtitle2">You can browse everything to find the best internship</p>
    <p class="overline"><?= $nbOfResults != 0 ? $nbOfResults . " results" : "" ?></p>
    <!-- make a responsive table -->
    <div class="table">
        <?php
        $path = "/public/assets/images/logos/";
        $logos = array("adobe", "airbnb", "amazon", "apple", "dropbox", "google", "microsoft", "shopify", "twitter", "uber", "atlassian", "paypal");
        $colors = array('255, 0, 0', '253, 92, 99', '255, 153, 0', '153, 153, 153', '0, 97, 255', '76, 144, 245', '3, 164, 239', '80, 184, 60', '0, 132, 255', '9, 9, 26', '0, 82, 204', '37, 59, 128');

        if (!isset($results) || Count($results) == 0) {
            echo "<div class='result_center'>";
            echo "<img draggable = false src='/public/assets/images/searching.png' alt=''>";
            echo "<h6>Browse something to see some results...</h6>";
            echo "</div>";
        } else {

            for ($i = $start; $i < $finish; $i++) {

                if (!isset($results[$i])) break;

                $url = $path . $logos[$i % Count($logos)] . ".png";
                $color = $colors[$i % Count($logos)];

                $value = $results[$i];

                // *  user style
                if (isset($value->isUser)) {
                    echo "<div class='user-item'>";
                    echo "<a href=" . $userRequest . $value->username . ">";
                    echo "<div class='logo-img'></div>";
                    echo "<div class='title'>";
                    echo "<p class='body1'>" . $value->firstname  . "</p>";
                    echo "<p class='body1'>" . $value->lastname . "</p>";
                    echo "</div>";
                    echo "<div class='activity_sector'>";
                    echo "<p class='body2'>" . $value->center . "</p>";
                    echo "</div>";
                    echo "<p class='body2'>" . $value->email . "</p>";
                    echo "<div class='location'>";
                    echo "<p class='body2'>" . getRoleById($value->ID_Role) . "</p>";
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
                // *  COMPANY
                elseif (isset($value->isCompany)) {
                    echo "<div class='company-item'>";
                    echo "<a href=" . $companyRequest . $value->business_name . ">";
                    echo " <div class='logo-img' style=\"background-image: url($url); background-color: rgb($color);\"></div>";
                    echo "<div class='title'>";
                    echo "<p class='body1'>" . $value->business_name . "</p>";
                    echo "</div>";
                    echo "<div class='activity_sector'>";
                    echo "<p class='body2'>" . $value->Activity_sector . "</p>";
                    echo "</div>";
                    echo "<div class='location'>";
                    echo "<p class='body2'>" .  $value->Locality . "</p>";
                    echo "</div>";
                    echo " <div class='reputation'>";
                    echo "    <p class='body1'> Rating</p>";
                    echo "    <span class='material-icons'>" . $value->Trainee_mark_Stars . "</span>";
                    echo " </div>";
                    echo "</a>";
                    echo "</div>";
                }
                // * OFFERS
                elseif (isset($value->isOffer)) {
                    echo "<article class='offers-item'>";
                    echo "<a href=" . $offerRequest . $value->business_name . ">"; //. "/" . $value->id_offer 
                    echo " <div class='logo-img' style=\"background-image: url($url); background-color: rgb($color);\"></div>";
                    echo " <div class='title'>";
                    echo "    <p class='body1'>" . $value->business_name . "</p>";
                    echo " <p class='body2'>" . $value->duration . "</p>";
                    echo " </div>";
                    echo "    <p class='body2'>" . $value->skills . "</p>";
                    echo " <p class='body2'>" . $value->localicy . "</p>";
                    echo " <p class='body2'>" . (int)$value->remuneration . " $ per month" . "</p>";
                    echo "</a>";
                    echo "</article>";
                };
            }
        }

        ?>

    </div>
    <div class="pagination">
        <?php
        if ($numberOfPage > 1) {
            if ($currentPage > 0) {
                echo "<a href=" . $pageRequest . ($currentPage - 1) . ">";
                echo "<p class='button'>previous</p>";
                echo "</a>";
            }
            echo "<div class='pagination-page_indication'>";
            echo "<p>" . $currentPage . "</p>";
            echo "</div>";
            if ($currentPage < $numberOfPage - 1) {
                echo "<a href= " . $pageRequest . ($currentPage + 1) . ">";
                echo "<p class='button'>next</p>";
                echo "</a>";
            }
        }
        ?>
    </div>
</section>
<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->
<script>
    window.onload = function() {
        document.getElementById("search_input").focus();
    }
</script>
<script src="public/Scripts/activity.js"></script>
<script src="public/Scripts/animations.js"></script>
<script src="public/Scripts/getDaytTime.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>

<?php require('mainPage_template.php'); ?>