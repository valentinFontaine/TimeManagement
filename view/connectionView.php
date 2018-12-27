<?php $title = 'Connexion' ?>

<?php ob_start(); ?>

<h1>Connexion</h1>

<form action="index.php?action=verifyIdentity" method="POST">
    
    <p><label for="mail">mail</label><input name="mail" type="text" value="" /></p>
    <p><label for="pass">Mot de passe : </label><input name="pass" type="password" value="" /></p>
    <p class="errorMessage"><?= $errorMessage ?></p>
    <p><input type="submit" value="Connexion" /></p>

</form>

<p>Si vous n'êtes pas inscrits, cliquez sur ce <a href='index.php?action=subscription'>lien</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');
