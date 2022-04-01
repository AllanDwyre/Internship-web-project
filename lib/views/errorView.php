<?php $title = 'InternShipp - Error'; ?>
<?php $style = 'error_view/error_view.css'; ?>

<?php ob_start(); ?>
<!-- Content -->

<div class="center">
    <h1><?= $error ?></h1>
    <h2><?= $errorMessage ?></h2>
    <img src=<?= $errorImage ?> alt="">
    <a href=<?= $errorRedirection  ?>>
        <p class="button">Go back to a known place</p>
    </a>
</div>
<!-- Content -->
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>