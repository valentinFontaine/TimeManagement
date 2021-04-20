<?php $title = 'vos projets'; ?>

<?php ob_start(); ?>

<h2> <?= $currentProject['name'] ?> </h2>


<form action="index.php?action=updateProject" method="POST" >
    
    <input type="hidden" id="projectId" name="projectId" value="<?= $currentProject['id'] ?>" />
    <p><label for="ProjectName">Nom</label><input type="text" name="projectName" id="projectName" value="<?= htmlSpecialChars($currentProject['name']) ?>" /></p>
    <p><label for="ProjectDescription">Description</label><textarea name="projectDescription" id="projectDescription"><?= htmlSpecialChars($currentProject['description']) ?></textarea></p>
    <p><input type="submit" value="Mise à jour" /></p>

</form>

<h2> Statistiques </h2>

<p> Avancement : <?= $progress ?>%</p>

<h2> Liste des tâches </h2>

<table>
    <tr>
        <th>Avancement</th>
        <th>Catégorie</th>
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
    <td><form action="index.php?action=endTask" method="POST"><input type="checkbox" id="checkTask_<?= $data['id'] ?>" name="checkTask_<?= $data['id'] ?>" onChange="submit();" <?= ($data['progress']==100) ? 'checked' : ''?>/><input type="Hidden" id="checkTaskHidden_<?= $data['id'] ?>" name="checkTaskHidden_<?= $data['id'] ?>" value="off"/></form></td> 
        <td><?= $data['category'] ?></td>
        <td><a href="index.php?action=viewTask&task_id=<?= $data['id'] ?>"><?= $data['task_name'] ?></a></td>
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
    <input type="hidden" name="project" id="project" value="<?= $currentProject['name'] ?>" />       
        <tr>
            <td></td>
            <td>
                <select name="category" id="category">
                    <option value="personal">perso</option>
                    <option value="workRelated">pro</option>
                </select>
            </td>
            <td><input type="text" name="task" id="task" placeholder="nom tâche" required/></td>
            <td><textarea name="description" id="description" placeholder="description de la tâche" ></textarea></td>
            <td><input type="text" name="estimated_duration" id="estimated_duration" placeholder="durée estimée" required /></td>
            <td><input type="range" min="1" max="4" step="1" name="importance" id="importance" placeholder="importance" title="1=Très importante, 4=peut important" /></td>
            <td><input type="date" name="due_date" id="due_date" placeholder="" required/></td>
        </tr>
        <tr>
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

