<?php 

require_once('Manager.php');

class TaskManager extends Manager
{
    function getTasksToDo($members_id)
    {
        $db = $this->dbConnect();

        $tasks = $db->prepare('SELECT category, members_id, project_id, task, description, estimated_duration, importance, due_date FROM tasks WHERE end_date = \'0000-00-00 00:00:00\' AND  members_id = :members_id');

        $tasks->execute(array('members_id'=>$members_id));

        return $tasks;
    }    

    function getTask($id)
    {
        $db = $this->dbConnect();

        $query = $db->prepare('SELECT category, project_id, task, description, estimated_duration, importance, entry_date, started_date, due_date, end_date FROM tasks WHERE id = :id');

        $task = $query->execute(array('id' => $id));

        return $task->fetch();
    }

    

}
