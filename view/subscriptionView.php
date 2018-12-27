<?php $title = 'Créer un compte !'; ?>

<?php ob_start(); ?>

    <h1>Inscription</h1>

    <form action="index.php?action=verifySubscription" method="POST" />
    
        <p><label>Prénom : </label><input name="first_name" value="" type="text" /></p>
        <p><label>Nom : </label><input name="last_name" value="" type="text" /></p>
        <p><label>Adresse mail : </label><input name="mail" value="" type="text" /></p>
        <p><label>Mot de passe : </label><input name="password_1" value="" type="password" /></p>
        <p><label>Confirmez votre mot de passe : </label><input name="password_2" value="" type="password" /></p>
        <p><input type="submit" value="s'inscrire" /></p>
        
    </form>
    <p class="errorMessage"><?= $errorMessage ?></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
