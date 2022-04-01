<?php $title = 'InternShipp - Activity'; ?>
<?php $style = 'activity/activity.css'; ?>

<?php ob_start(); ?>

<!-- Content -->
<div class="split">

    <section class="notification">
        <p class="caption">Vendredi 25 mars </p>
        <article class="notification-add_user">
            <p>
                Aceptez-vous que <span class="high_emphasis"> Allan Golding Dwyre </span> se créer un compte ?
            </p>
            <div class="actions">
                <span class="material-icons">
                    done
                </span>
                <span class="material-icons">
                    close
                </span>
            </div>
        </article>
        <article class="notification-info">
            <p>
                <span class="high_emphasis"> Amazon </span> a répondu à <span class="high_emphasis"> Julie Ruellan </span> suite à sa postulation.
            </p>

        </article>
        <article class="notification-info read">
            <p>
                Vous avez acceptez que <span class="high_emphasis"> Marvin Razen </span> se créer un compte.
            </p>
            <div class="actions">
                <span class="material-icons">
                    done
                </span>
                <span class="material-icons">
                    close
                </span>
            </div>
        </article>
    </section>
    <section class="right">
        <img src="public/assets/images/new_notification.png" alt="notification">
    </section>
</div>
<!-- Content -->
<?php $content = ob_get_clean(); ?>

<!-- Script -->

<?php ob_start(); ?>
<script src="public/Scripts/animations.js"></script>
<?php $scripts = ob_get_clean(); ?>
<!-- Script -->

<?php require('mainPage_template.php'); ?>