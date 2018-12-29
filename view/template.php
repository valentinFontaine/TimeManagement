<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="public/css/style.css" />
    </head>
    
    <body>
    <nav>
        <ul>
            <li><a href="index.php?action=listTask">Liste des Tâches à faire</a></li>
        </ul>
    </nav>
    <?= $content ?>
    
    </body>
</html>
    
