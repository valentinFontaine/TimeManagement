<?php $title = 'Bienvenue'; ?>


<h1> Merci de votre visite ! </h1>

<p>Pour revenir au site, suivez ce <a href="../index.php">lien</a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

