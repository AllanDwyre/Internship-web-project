<?php $title = 'InternShipp - Manage Account'; ?>
<?php $style = 'manage_account/manage_account.css'; ?>

<?php ob_start(); ?>
<!-- Content -->
<div class="modal">
    <h5>Add User Account</h5>
    <p class="subtitle1">Here you can add a user account to the website.</p>
    <form action="" method="POST">
        <div class="input_item">
            <div class="label">
                <p>Username</p>
            </div>
            <div class="input_container">
                <p class="button">
                    internshipp.com/profile/
                </p>
                <div class="separator_line"></div>
                <input name="username" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Password</p>
            </div>
            <div class="input_container">
                <span class="material-icons-outlined">
                    password
                </span>
                <div class="separator_line"></div>
                <input type="password" name="password" placeholder="Enter your password" required />
                <span class="material-icons-outlined password_btn">
                    visibility_off
                </span>
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>First Name</p>
            </div>
            <div class="input_container">
                <input name="firstname" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Last Name</p>
            </div>
            <div class="input_container">
                <input name="lastname" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Email</p>
            </div>
            <div class="input_container">
                <span class="material-icons-outlined">
                    email
                </span>
                <div class="separator_line"></div>

                <input name="email" type="email" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Center</p>
            </div>
            <div class="input_container">
                <input name="center" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Role</p>
            </div>
            <div class="input_container">
                <input name="role" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Promotion</p>
            </div>
            <div class="input_container">
                <input name="promotion" type="text" required />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Your photo</p>
                <p class="subtitle2">This will be displayed on your profile</p>
            </div>
            <div class="input_container-photo">
                <img id="image_preview" src="/public/assets/images/userProfileTest.jpg" alt="">
                <div>
                    <label for="image_file_input">
                        <p class="button">Change your photo</p>
                    </label>
                    <input name="avatar" id="image_file_input" type="file" accept="image/x-png,image/gif,image/jpeg" />

                </div>

            </div>
        </div>
        <button type="submit">
            <p class="button">Create Account</p>
        </button>

    </form>
</div>

<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->
<script>
    $(".sort-list").children().click(function() {
        tab = $(this).text();
        tabsDisplay(tab)
        $(".sort-list").children().removeClass("active");
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
<script>
    $(".password_btn").click(function() {
        if ($(this).text() == "visibility_off") {
            $(this).parent().find("input").attr({
                type: "text"
            });
            $(this).text("visibility");
            $(this).css({
                color: "#2c2c2c"
            });
        } else {
            $(this).parent().find("input").attr({
                type: "password"
            });
            $(this).text("visibility_off");
            $(this).css({
                color: "#a7a7a7"
            });
        }
    })
</script>
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
<script src="Scripts/getDaytTime.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>


<?php require('mainPage_template.php'); ?>