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
    $taskList = $tasks->getTasksToDo($_SESSION['id'], $_SESSION['category']);
    $projects = new ProjectManager();
    $projectList = $projects->getProjects($_SESSION['id'], $_SESSION['category']);

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
    
    if( !empty($category) && !empty($name) && !empty($estimated_duration) && !empty($importance) && !empty($due_date) && isset($_SESSION['id']))
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
        throw new Exception('Champs vides');
    }

}

function endTask($tableCheck)
{

    require_once('model/TaskManager.php');


    
    $tasks = new TaskManager();
    
    $currentTask = $tasks->getTask($tableCheck['id']);

    if (isset($currentTask['id']))
    {
        if (($currentTask['members_id'] == $_SESSION['id']) AND ($tableCheck['value'] == 'on'))
        {
            $tasks->endTask($currentTask['id']);
        }
        else
        {
            throw new Exception ('Cette tâche ne vous appartient pas ! vous ne pouvez pas la terminer');
        }
    }
    else
    {
        throw new Exception ('Tâche n\'existe pas');
    }
   header('Location: index.php?action=listTask');       

}

function getTaskCheckId($post)
{

    $taskId = '';
    $table = array();
    $message = '';

    foreach($post as $name => $value)
    {
        
        $message = $message . '<br />['. $name . '] : ' . $value;
        if (preg_match("#^checkTask_[0-9]+$#", $name) )
        {
            
            $taskId = intval(substr($name, strlen("checkTask_")));
            $table = array('id' => $taskId, 'value' => $value);
            return $table;
        }
    }

    throw new Exception($message);

    return $table;
}


function getListCategory()
{
    if (!isset($_SESSION['category']))
    {
        $_SESSION['category'] = '%';
    }

    $i = 0;
    
    $listCategory = array();

    $listCategory[0][0] = $_SESSION['category'];
    $listCategory[0][1] = translateCategory($_SESSION['category']);

    if ($_SESSION['category'] != 'personal')    
    {
        $listCategory[$i+1][0] = 'personal';
        $listCategory[$i+1][1] = translateCategory('personal');
        $i = $i + 1;
    }
    
    if ($_SESSION['category'] != 'workRelated')
    {
        $listCategory[$i+1][0] = 'workRelated';
        $listCategory[$i+1][1] = translateCategory('workRelated');
        $i = $i + 1;
    }
    if ($_SESSION['category'] != '%')
    {
        $listCategory[$i+1][0] = '%';
        $listCategory[$i+1][1] = translateCategory('%');
        $i = $i + 1;
    }


    return $listCategory;
}

function translateCategory($category)
{
    switch ($category)
    {
        case 'personal' :
            $result = 'perso';
            break;
        case 'workRelated' : 
            $result = 'pro';
            break;
        case '%' : 
            $result = 'Tout';
            break;
        default : 
            $result = '';
            break;
    }
    return $result;
}

function setCategory()
{
    if (isset($_POST['sessionCategory']))
    {
        if (($_POST['sessionCategory'] == 'personal') Or ($_POST['sessionCategory'] == 'workRelated') Or ($_POST['sessionCategory'] == '%'))
        {
            $_SESSION['category'] = $_POST['sessionCategory'];
        }
        else
        {
            $_SESSION['category'] = '%';
        }
    }
    else 
    {
        $_SESSION['category'] = '%';
    }
} 
                

