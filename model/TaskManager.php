<?php 

require_once('Manager.php');

class TaskManager extends Manager
{
    function getTasksToDo($members_id)
    {
        $db = $this->dbConnect();
        //$tasks = $db->prepare('SELECT category, members_id, project_id, name, description, estimated_duration, importance, due_date FROM tasks WHERE end_date = \'0000-00-00 00:00:00\' AND  members_id = :members_id');
            
        $tasks = $db->prepare('SELECT tasks.category as category, tasks.members_id as members_id, projects.name as project_name, tasks.name as task_name, tasks.description as description, tasks.estimated_duration as estimated_duration, tasks.importance as importance, tasks.due_date as due_date FROM tasks INNER JOIN projects ON tasks.project_id = projects.id WHERE tasks.end_date = \'0000-00-00 00:00:00\' AND  tasks.members_id = :members_id');

        $tasks->execute(array('members_id'=>$members_id));

        return $tasks;
    }    

    function getTask($id)
    {
        $db = $this->dbConnect();

        $query = $db->prepare('SELECT category, project_id, name, description, estimated_duration, importance, entry_date, started_date, due_date, end_date FROM tasks WHERE id = :id');

        $task = $query->execute(array('id' => $id));

        $currentTask = $task->fetch();

        $task->closeCursor();

        return $currentTask;
    }

    function addTask($category, $project_id, $members_id, $task, $description, $estimated_duration, $importance, $due_date)
    {
        $db = $this->dbConnect();
//*
        $query = $db->prepare('INSERT INTO tasks(category, project_id, members_id, name, description, due_date, importance, estimated_duration) VALUES (:category, :project_id, :members_id, :name, :description, :due_date, :importance, :estimated_duration)');

        $affectedLines = $query->execute(array('category'=>$category, 'project_id' => $project_id, 'members_id' => $members_id, 'name' => $task, 'description' => $description, 'due_date' => $due_date, 'importance'=> $importance, 'estimated_duration'=> $estimated_duration));

        $query->closeCursor();
        return $affectedLines;
    }
}
