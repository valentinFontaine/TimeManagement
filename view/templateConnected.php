<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="public/css/style.css" />
    </head>

     <nav>
        <a href="index.php?action=welcome">Accueil</a>
        <a href="index.php?action=listTask">Liste des Tâches à faire</a>
        <a href="index.php?action=schedule">Planification</a>

        <form action="" method="POST" >
            <select name="sessionCategory" id="sessionCategory" onChange="submit();">
                <?php
                    $i = 0;
                    while($i <= 2)
                    {
                    ?>
                        <option value="<?= $listCategory[$i][0] ?>" ><?= $listCategory[$i][1] ?></option>
                <?php
                        $i = $i + 1;
                    }
                ?>

            </select>
        </form>
    </nav>
   
    <body>
        <?= $content ?>
    </body>
</html>
 
