<?php $title = 'InternShipp - Profile'; ?>
<?php $style = 'profile/profile.css';

?>

<?php ob_start(); ?>
<!-- Content -->
<nav class="profile_nav">
    <div class="profile_nav-items">
        <div class="tabs">
            <button class="button active">Profile</button>
            <button class="button">My details</button>
            <button class="button">Password</button>
            <!-- <button class="button">Notifications</button> -->
        </div>
        <form action=<?= $_isMyAccount ? $logoutRequest :  $deleteAccountRequest ?> method="POST">
            <button id="log_out" class="button"><?= $_isMyAccount ? "Log out" : "Delete Account" ?></button>
        </form>
    </div>
    <div class="line"></div>
</nav>
<section class="profile_section">
    <h5>Profile</h5>
    <p class="subtitle2">This is what's other people see on your profile.</p>
    <section class="profile_info">
        <img class="profile_picture" src="/public/assets/images/userProfileTest.jpg" alt="profile_picture">

        <div class="info_text">
            <p class="overline role"><?= $profileInfo->role ?></p>
            <h5 class="name"><?= $profileInfo->firstname ?> <?= $profileInfo->lastname ?> </h5>
            <p class="caption">Montpellier, France</p>
            <p class="subtitle objectif">Searching for internship in <span>Robotics</span> and <span>Computer Science</span></p>
            <div class="overhaul">
                <div class="overhaul-item">
                    <a href="">
                        <p class="body2">Companies Applied</p>
                        <p class="subtitle2">8</p>
                    </a>
                </div>
                <div class="overhaul-item">
                    <a href="">
                        <p class="body2">WishList</p>
                        <p class="subtitle2">12</p>
                    </a>
                </div>
                <div class="overhaul-item">
                    <a href="">
                        <p class="body2">Internship In Progress</p>
                        <p class="subtitle2">4</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="wishlist">
        <h5 class="category-title">Wish-list</h5>
        <div class="split">
            <div class="split-left">
                <article class='wishlist-item'>
                    <div class='wishlist-item-content'>
                        <div class="logo-img"></div>
                        <div class='wishlist-information'>
                            <p class='body1'>Company Name</p>
                        </div>
                        <p class='body1'>Localicy</p>
                        <p class='body1'>Duration</p>
                        <p class='body1'>Remuneration</p>
                    </div>
                    <div class='separationLine'></div>
                </article>
                <?php
                if (isset($wishlistInfos)) {
                    foreach ($wishlistInfos as  $value) {
                        echo "<article class='wishlist-item'>";
                        echo " <div class='wishlist-item-content'>";
                        echo " <div class='logo-img' style=\"background-image: url(" .
                            "/public/assets/images/logos/google.png" . "); background-color: rgb(" .
                            '0, 97, 255' . ");\"></div>";
                        echo " <div class='wishlist-information'>";
                        echo "    <p class='body1'>" . $value["CompanyName"] . "</p>";
                        echo "    <p class='body1'>" . $value["skills"] . "</p>";
                        echo " </div>";
                        echo " <p class='body1'>" . $value["localicy"]  . "</p>";
                        echo " <p class='body1'>" . $value["duration"] . "</p>";
                        echo " <p class='body1'>" . (int)$value["remuneration"] . ' $ per month' . "</p>";
                        echo "<a href=" . $value["requestOnBookmarkClick"] . "><span class='material-icons-outlined remove-btn'> bookmark_remove </span></a>";
                        echo "</div>";
                        echo "<div class='separationLine'></div>";
                        echo "</article>";
                    }
                } else {
                    echo "<div class='wishlist-no_content'>";
                    echo '<img draggable="false" src="/public/assets/images/no_results.png" alt="no-content-img">';
                    echo "<p class='body2'> You don't have a wish-list";
                    echo "</div>";
                }
                ?>
            </div>
            <article class="split-right">
                <img draggable="false" src="/public/assets/images/wishlist.png" alt="right-img">
            </article>
        </div>
    </section>
</section>
<section class="details_section">
    <h5>My Details</h5>
    <p class="subtitle2">Update your photo and personal details here.</p>
    <form action=<?= $updateRequest ?> method="POST">

        <div class="input_item">
            <div class="label">
                <p>Username</p>
            </div>
            <div class="input_container">
                <p class="button">
                    internshipp.com/profile/
                </p>
                <div class="separator_line"></div>
                <input name="username" type="text" value=<?= $profileInfo->username ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>First Name</p>
            </div>
            <div class="input_container">
                <input name="firstname" type="text" value=<?= $profileInfo->firstname ?> />
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>Last Name</p>
            </div>
            <div class="input_container">
                <input name="lastname" type="text" value=<?= $profileInfo->lastname; ?> />
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

                <input name="email" type="email" value=<?= $profileInfo->email ?> />
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
                    <input id="image_file_input" type="file" accept="image/x-png,image/gif,image/jpeg" />

                </div>

            </div>
        </div>

        <button type="submit">
            <p class="button">Apply</p>
        </button>

    </form>
</section>
<section class="password_section">
    <h5>Password</h5>
    <p class="subtitle2">Manage the password here.</p>
    <form action=<?= $changePasswordRequest ?> method="POST">
        <div class="input_item">
            <div class="label">
                <p>Password</p>
            </div>
            <div class="input_container">
                <span class="material-icons-outlined">
                    password
                </span>
                <div class="separator_line"></div>
                <input type="password" name="password" placeholder="Enter your password">
                <span class="material-icons-outlined password_btn">
                    visibility_off
                </span>
            </div>
        </div>
        <div class="input_item">
            <div class="label">
                <p>New Password</p>
            </div>
            <div class="input_container">
                <span class="material-icons-outlined">
                    password
                </span>
                <div class="separator_line"></div>
                <input type="password" name="newpassword" placeholder="Enter your new password">
                <span class="material-icons-outlined password_btn">
                    visibility_off
                </span>
            </div>
        </div>
        <button type="submit">
            <p class="button">Change Password</p>
        </button>
    </form>
</section>
<form id="profile_logout" action=<?= $_isMyAccount ? $logoutRequest :  $deleteAccountRequest ?> method="POST">
    <button id="log_out" class="button"><?= $_isMyAccount ? "Log out" : "Delete Account" ?></button>
</form>
<!-- Content -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Script -->
<script>
    let tab = "Profile";
    sections = {
        "Profile": ".profile_section",
        "My details": ".details_section",
        "Password": ".password_section",
    }
    $(".tabs").children().click(function() {
        tab = $(this).text();
        tabsDisplay(sections, tab)
        $(".tabs").children().removeClass("active");
        $(this).addClass("active");
    })

    function tabsDisplay(sections, tab) {
        for (var key in sections) {
            if (key == tab) {
                $(sections[key]).css({
                    "display": "block",
                })
                continue;
            }

            $(sections[key]).css({
                "display": "none"
            })
        }
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
<script src="Scripts/activity.js"></script>
<script src="Scripts/animations.js"></script>
<script src="Scripts/getDaytTime.js"></script>
<!-- Script -->
<?php $scripts = ob_get_clean(); ?>

<?php require('mainPage_template.php'); ?>

<!-- https://dribbble.com/shots/16586392-Profile-settings-page-Untitled-UI -->