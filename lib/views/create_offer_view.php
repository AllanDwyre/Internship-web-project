<?php $title = 'InternShipp - Offer'; ?>
<?php $style = 'manage_account/manage_account.css'; ?>

<?php ob_start();

?>
<!-- Content -->
<div class="modal">
    <h5><?= isset($offerData) ? "Modify an Offer" : "Add an Offer" ?></h5>
    <p class="subtitle1"><?= isset($offerData) ? "Here you can modify an offer." : "Here you can add an offer to the website." ?></p>
    <form action="" method="POST">
        <div class="input_item">
            <div class="label">
                <p>Offer Skill</p>
            </div>
            <div class="input_container">

                <input name="skills" type="text" required <?= isset($offerData) ? "value =" . $offerData->skills : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Offer localicy</p>
            </div>
            <div class="input_container">
                <input name="localicy" type="text" required <?= isset($offerData) ? "value =" . $offerData->localicy : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Duration</p>
            </div>
            <div class="input_container">
                <input name="duration" type="text" required <?= isset($offerData) ? "value =" . $offerData->duration : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Remuneration</p>
            </div>
            <div class="input_container">
                <input name="remuneration" type="number" required <?= isset($offerData) ? "value =" . $offerData->remuneration : null ?> />
            </div>
            <input name="id_form" type="hidden" value="1" />
        </div>
        <div class="input_item">
            <div class="label">
                <p>Offer Date</p>
            </div>
            <div class="input_container">
                <input name="offer_date" type="datetime-local" min=<?= gmdate("l jS \of F Y h:i:s A") ?> <?= isset($offerData) ? "value =" . $offerData->offer_date : null ?> required />
            </div>
            <?php
            if (!isset($offerData))
                echo "<input name='id_form' type='hidden' value=<?= $id_form ?> />";
            ?>
            <!-- On reset le added_date -->
            <input name="added_date" type="hidden" value=<?= gmdate("l jS \of F Y h:i:s A") ?> />

        </div>
        <button type="submit">
            <p class="button"><?= isset($offerData) ? "Modify Offer" : "Create Offer" ?></p>
        </button>
        <a id="go_back" href=<?= isset($offerData) ? "/company/" . $offerData->companyName : "/" ?>>Go Back</a>

    </form>
</div>

<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_file_input").change(function() {
        readURL(this);
    });
</script>
<script src="Scripts/animations.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>


<?php require('mainPage_template.php'); ?>