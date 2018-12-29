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

    $tasks = new TaskManager();
    $taskList = $tasks->getTasksToDo($_SESSION['id']);

    /*
    foreach($taskList as $key => $element)
    {
        $taskList[$key] = htmlspecialchars($taskList[$key]);
    }
    //*/
    require('view/listTaskView.php');
}


