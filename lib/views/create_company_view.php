<?php $title = 'InternShipp - Manage Account'; ?>
<?php $style = 'manage_account/manage_account.css'; ?>

<?php ob_start(); ?>
<!-- Content -->
<div class="modal">
    <h5> <?= isset($companyInfo) ? "Modify Company Account" : "Add Company Account" ?> </h5>
    <p class="subtitle1"> <?= isset($companyInfo) ? "Here you can modify a company to the website." : "Here you can add a company to the website." ?></p>
    <form action="" method="POST">
        <div class="input_item">
            <div class="label">
                <p>Company Name</p>
            </div>
            <div class="input_container">
                <p class="button">
                    internshipp.com/company/
                </p>
                <div class="separator_line"></div>
                <input name="business_name" type="text" required <?= isset($companyInfo) ? "value=" . $companyInfo->business_name : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Activity Sector</p>
            </div>
            <div class="input_container">
                <input name="Activity_sector" type="text" required <?= isset($companyInfo) ? "value=" . $companyInfo->Activity_sector : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Locality</p>
            </div>
            <div class="input_container">
                <input name="Locality" type="text" required <?= isset($companyInfo) ? "value=" . $companyInfo->Locality : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Number of CESI trainees</p>
            </div>
            <div class="input_container">
                <input name="Number_Cesi_trainees" type="text" required <?= isset($companyInfo) ? "value=" . $companyInfo->Number_Cesi_trainees : null ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Company Icon</p>
            </div>
            <div class="input_container-photo">
                <img id="image_preview" src="/public/assets/images/userProfileTest.jpg" alt="">
                <div>
                    <label for="image_file_input">
                        <p class="button">Get an icon for the company!</p>
                    </label>
                    <input name="icon" id="image_file_input" type="file" accept="image/x-png,image/gif,image/jpeg" />

                </div>

            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Company Color</p>
            </div>
            <div class="input_container">
                <input name="themeColor" type="color" />
            </div>
        </div>
        <button type="submit">
            <p class="button">Apply to the offer</p>
        </button>

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