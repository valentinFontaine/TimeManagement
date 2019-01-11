<?php 

function viewProject($id)
{
    require_once('model/TaskManager.php');
    require_once('model/ProjectManager.php');

    $tasks = new TaskManager();
    $projects = new ProjectManager();

    
    if (preg_match('#^[0-9]+$#', $id))
    {
        $currentProject = $projects->getProject($id);

        if ($currentProject['members_id'] == $_SESSION['id'])
        {
            $taskList = $tasks->getTasksFromProject($id);

            $progress = 12;
            require('view/projectView.php');
        }
        else
        {
            throw new Exception ('Accès non autorisé !');
        }
    }
    else
    {
        throw new Exception('Projet non défini');
    }
            

}


