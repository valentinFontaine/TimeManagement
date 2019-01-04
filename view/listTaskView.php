<?php $title = 'Vos tâches'; ?>

<?php ob_start(); ?>

<h2> Travail restant à faire ! </h2>

<table>
    <tr>
        <th>Terminer Tâche</th>
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
        <td><form action="index.php?action=endTask" method="POST"><input type="checkbox" id="checkTask_<?= $data['id'] ?>" name="checkTask_<?= $data['id'] ?>" onChange="submit();"/></form></td> 
        <td><?= $data['category'] ?></td>
        <td><?= $data['project_name'] ?></td>
        <td><?= $data['task_name'] ?></td>
        <td><?= $data['description'] ?></td>
        <td><?= $data['estimated_duration'] ?></td>
        <td><?= $data['importance'] ?></td>
        <td><?= $data['due_date'] ?></td>
    </tr>
<?php
    }
    $taskList->closeCursor();
?>

    <form action="index.php?action=addTask" method="POST">
        <tr>
            <td></td>
            <td>
                <select name="category" id="category">
                    <option value="personal">perso</option>
                    <option value="workrelated">pro</option>
                </select>
            </td>
            <td>
                <input list="projectList" name="project" id="project" autocomplete="off" />
                <datalist name="projectList" id="projectList">
                    <?php 
                        while($project = $projectList->fetch())
                        {
                    ?>
                        <option value="<?= $project['name'] ?>" >
                    <?php
                        }
                        $projectList->closeCursor();
                    ?>
                </datalist>
            </td>
            <td><input type="text" name="task" id="task" placeholder="nom tâche" /></td>
            <td><textarea name="description" id="description" placeholder="description de la tâche"></textarea></td>
            <td><input type="text" name="estimated_duration" id="estimated_duration" placeholder="durée estimée" /></td>
            <td><input type="range" min="1" max="4" step="1" name="importance" id="importance" placeholder="importance" title="1=Très importante, 4=peut important" /></td>
            <td><input type="date" name="due_date" id="due_date" placeholder="" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>           
            <td></td>       
            <td></td> 
            <td></td>
            <td></td>
            <td><input type="submit" value="Ajouter là tâche" /></td>
        </tr>
    </form>
</table>
<?php $content = ob_get_clean(); ?>

<?php require('controller/templateConnected.php'); ?>

