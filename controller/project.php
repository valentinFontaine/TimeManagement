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

            $progress = $projects->getProjectProgress($id);
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

function updateProject($id, $name, $description)
{
    require_once('model/ProjectManager.php');

    $projects = new ProjectManager();
    $currentProject = $projects->getProject($id);

    if (isset($currentProject['id']))
    {
        if (($currentProject['members_id'] == $_SESSION['id']))
        {
            $affectedLines = $projects->updateProject($id, $name, $description, $_SESSION['id']);
            if ($affectedLines == false)
            {
                throw new Exception('Le projet n\'a pas pu être mis à jour');
            }
            else
            {
                
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

        }
        else
        {

            throw new Exception ('Ce projet ne vous appartient pas ! vous ne pouvez pas le mettre à jour');
        }
    }
    else
    {
        throw new Exception ('Le projet n\'existe pas');
    }

}

