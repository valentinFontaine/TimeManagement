<?php $title = 'Vos tâches'; ?>

<?php ob_start(); ?>

<h2> Travail restant à faire ! </h2>

<table>
    <tr>
        <th>Catégorie</th>
        <th>Projet</th>
        <th>Tâche</th>
        <th>Description</th>
        <th>durée estimée</th>
        <th>importance</th>
        <th>Date due</th>
    </tr>
<?php
    while($data = $taskList->fetch())
    {
?>
    <tr>
        <td><?= $data['category'] ?></td>
        <td><?= $data['project_id'] ?></td>
        <td><?= $data['task'] ?></td>
        <td><?= $data['description'] ?></td>
        <td><?= $data['estimated_duration'] ?></td>
        <td><?= $data['importance'] ?></td>
        <td><?= $data['due_date'] ?></td>
    </tr>
<?php
    }
    $taskList->closeCursor();
?>

</table>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

