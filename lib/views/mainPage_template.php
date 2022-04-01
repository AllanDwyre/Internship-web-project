<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/assets/images/logo.png" />
    <link rel="manifest" href="/manifest.json" />
    <link rel="description" href="Site: intershipp, Objectif: search intern management" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/public/styles/<?= $style ?>">
</head>

<body>

    <nav class="nav">
        <div class="nav_mobile">
            <span id="go_back" class="material-icons-outlined" onclick="goBack()">
                arrow_back_ios
            </span>
            <p><?= $title ?></p>
            <a href="/manage_account"><span class="material-icons-outlined">
                    groups
                </span></a>
        </div>
        <div class="nav_laptop">
            <a href="/" class="logo"><img draggable="false" src="/public/assets/images/logo.png" alt="logo" /></a>
            <div class="main_links">
                <a href="/home"><span class="material-icons-outlined">
                        home
                    </span>
                    <p class="body1">Home</p>
                </a>
                <a href="/search"><span class="material-icons-outlined">
                        search
                    </span>
                    <p class="body1">Search</p>
                </a>
                <a href="/activity"><span class="material-icons-outlined">
                        notifications
                    </span>
                    <p class="body1">Activity</p>
                </a>
                <a href="/profile"><span class="material-icons-outlined">
                        person
                    </span>
                    <p class="body1">Profile</p>
                </a>
                <hr />
                <div class="optional_links">
                    <a href="/manage_account"><span class="material-icons-outlined">
                            groups
                        </span>
                        <p class="body1">Manage Accounts</p>
                    </a>

                </div>
            </div>
            <div class="white-space"></div>
        </div>
    </nav>

    <section class="nav_mobile_footer">
        <a href="/home"><span class="material-icons-outlined">
                home
            </span>
            <p class="caption">Home</p>
        </a>
        <a href="/search"><span class="material-icons-outlined">
                search
            </span>
            <p class="caption">Search</p>
        </a>
        <a href="/activity"><span class="material-icons-outlined">
                notifications
            </span>
            <p class="caption">Activity</p>
        </a>
        <a href="/profile"><span class="material-icons-outlined">
                person
            </span>
            <p class="caption">Profile</p>
        </a>
    </section>

    <main class="main_content">
        <!-- add some functionnality (search, add compagnies)-->
        <div class="content">
            <header class="content_header">
                <h4 id="title"><?= $title ?></h4>
                <div class="right">
                    <button>
                        <span class="material-icons-outlined">add</span>
                        <p class="button"> Create a company</p>
                    </button>
                    <div class="search_container" id="nav_search">
                        <input class="button" type="search" name="nav_search" id="nav_search_input">
                        <span class="material-icons-outlined">
                            search
                        </span>
                    </div>
                </div>
            </header>
            <?= $content ?>
        </div>
    </main>

    <?= $scripts ?>
    <script>
        function goBack() {
            window.history.back();
        }
        if (screen.width < 576) {
            $("#title").css({
                "display": "none"
            })
        }
        let uri = window.location.href;
        $(".main_links, .nav_mobile_footer").children().toArray().forEach(element => {
            let pageURI = element.getAttribute('href');
            if (uri.includes(pageURI)) {
                element.classList.toggle("active");
            }
        });

        $("#nav_search").click(function() {
            $("#nav_search_input").focus();
        })
        $("#nav_search_input").focusin(function() {
            $("#nav_search").css({
                width: "300px",
                background: "rgba(0, 0, 0, 0.03)"
            })
        })
        $("#nav_search_input").focusout(function() {
            $("#nav_search").css({
                width: "20px",
                background: "transparent"
            })
        })
    </script>
    <script src="/main.js"></script>
</body>

<!-- https://www.w3schools.com/howto/howto_js_snackbar.asp -->
<!-- https://www.w3schools.com/howto/howto_js_autocomplete.asp -->

</html>