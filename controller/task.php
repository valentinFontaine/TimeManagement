<?php

function welcome()
{
    require_once('model/MembersManager.php');

    $member = new MembersManager();
    $currentMember = $member->getMember($_SESSION['id']);

    $first_name = htmlspecialchars($currentMember['first_name']);
    $last_name = htmlspecialchars($currentMember['last_name']);

    require('view/welcomeView.php');
}

function listTask()
{
    require_once('model/TaskManager.php');
    require_once('model/ProjectManager.php');

    $tasks = new TaskManager();
    $taskList = $tasks->getTasksToDo($_SESSION['id']);
    $projects = new ProjectManager();
    $projectList = $projects->getProjects($_SESSION['id']);

    require('view/listTaskView.php');
}

function addTask($category, $projectName, $name, $description, $estimated_duration,  $importance, $due_date)
{
    require_once('model/TaskManager.php');
    require_once('model/ProjectManager.php');

    $projectId = 1;

    $tasks = new TaskManager();
    $projects = new ProjectManager();



    if ($projectName == '')
    {
        $projectName = "Autres Tâches";
    }

    $project = $projects->getProjectByName($projectName, $_SESSION['id']);

    if (empty($project))
    {
        $affectedLines = $projects->addProject(htmlspecialchars($projectName));

        if ($affectedLines == false)
        {
            throw new Exception("Impossible de créer le projet");
        }
        else
        {
            $project = $projects->getProjectByName(htmlspecialchars($projectName), $_SESSION['id']);

        }
    }
    
    if( !empty($category) && !empty($name) && !empty($description) && !empty($estimated_duration) && !empty($importance) && !empty($due_date) && isset($_SESSION['id']))
    {
        $affectedLines = $tasks->addTask(htmlspecialchars($category), htmlspecialchars($project['id']), $_SESSION['id'],  htmlspecialchars($name), htmlspecialchars($description), htmlspecialchars($estimated_duration), htmlspecialchars($importance), htmlspecialchars($due_date) . ' 00:00:00');


        if ($affectedLines == false) 
        {
            throw new Exception('Tâche non ajoutée');
        }
        else
        {
           header('Location: index.php?action=listTask');       
        }
    }
    else
    {
        header('Location : index.php?action=listTask&error=emptyField');
    }

}


