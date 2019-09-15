<?php 

require_once('Manager.php');

class ScheduleManager extends Manager
{
    function getScheduledTasks($members_id, $category)
    {
        $db = $this->dbConnect();
            
        $tasks = $db->prepare('SELECT 
                                    tasks.id as id, tasks.category as category, tasks.members_id as members_id,projects.id as project_id,  projects.name as project_name, tasks.name as task_name,
                                    tasks.description as description, tasks.estimated_duration as estimated_duration, tasks.importance as importance, tasks.due_date as due_date, tasks.progress as progress
                                FROM    
                                    tasks INNER JOIN projects ON tasks.project_id = projects.id 
                                WHERE 
                                    tasks.end_date = \'0000-00-00 00:00:00\' AND  tasks.members_id = :members_id AND tasks.category LIKE :category');

        $tasks->execute(array('members_id'=>$members_id, 'category' => $category));

        return $tasks;
    }    


}
