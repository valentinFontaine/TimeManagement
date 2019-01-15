<?php $title = 'Tâches'; ?>

<?php ob_start(); ?>

<h2> <?= $currentTask['name'] ?> </h2>


<form action="index.php?action=updateTask" method="POST" >
    
    <input type="hidden" id="taskId" name="taskId" value="<?= $currentTask['id'] ?>" />
    <p>
        <select name="category" id="category">
            <option value="personal" <?= ($currentTask['category'] == 'personal') ? 'selected' :  ''; ?>>perso</option>
            <option value="workrelated" <?= ($currentTask['category'] == 'workrelated') ? 'selected' : ''; ?>>pro</option>
        </select>
    </p>

    <p><input list="projectList" name="project" id="project" autocomplete="off" /></p>
    <p>
        <datalist name="projectList" id="projectList" value="<?= $currentTask['projectName'] ?>">
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
    </p>
    <p><input type="text" name="task" id="task" value="<?= $currentTask['name'] ?>" required/></p>
    <p><textarea name="description" id="description" ><?= $currentTask['description'] ?></textarea></p>
    <p><input type="text" name="estimated_duration" id="estimated_duration" value="<?= $currentTask['estimated_duration'] ?>" required /></p>
    <p><input type="range" min="1" max="4" step="1" name="importance" id="importance" value="<?= $currentTask['importance'] ?>" title="1=Très importante, 4=peut important" /></p>
    <p><input type="date" name="due_date" id="due_date" value="<?= substr($currentTask['due_date'], 10)?>" required/></p>
    <p><input type="submit" value="Mise à jour" /></p>

</form>

<?php $content = ob_get_clean(); ?>

<?php require('controller/templateConnected.php'); ?>
