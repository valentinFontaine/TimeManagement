<?php $title = 'Bienvenue'; ?>

<?php ob_start(); ?>

<h1> Bienvenue ! </h1>

    <p>Bonjour <?= $first_name . ' ' . $last_name ?></p>

    <form action="index.php?action=signOut" method="POST">
        <input type="submit" value="Se deconnecter" />
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

