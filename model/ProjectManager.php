<?php 

require_once('Manager.php');

class ProjectManager extends Manager
{
    function getProjects($members_id)
    {
        $db = $this->dbConnect();

        $projects = $db->prepare('SELECT id, members_id, name, description FROM projects WHERE  members_id = :members_id');

        $projects->execute(array('members_id'=>$members_id));

        return $projects;
    }    

    function getProject($id)
    {
        $db = $this->dbConnect();

        $project = $db->prepare('SELECT id, members_id, name, description FROM projects WHERE id = :id');

        $project->execute(array('id' => $id));

        $currentProject = $project->fetch();

        $project->closeCursor();
        return $currentProject; 
    }

    function getProjectByName($name, $members_id)
    {
        $db = $this->dbConnect();

        $query = $db->prepare('SELECT id, members_id, name, description FROM projects WHERE name = :name AND members_id = :members_id');

        $query->execute(array('name' => $name, 'members_id' => $members_id));

        $project = $query->fetch();

        $query->closeCursor();

        return $project; 
    }
    function addProject($projectName)
    {
        $db = $this->dbConnect();

        $query = $db->prepare('INSERT INTO projects(name, members_id) VALUES (:name, :members_id)');
        $affectedLines = $query->execute(array('name' => $projectName, 'members_id' => $_SESSION['id']));

        $query->closeCursor();

        return $affectedLines;
    }

    function updateProject($id, $name, $description, $members_id)
    {
        $db = $this->dbConnect();
        $query = $db->prepare('UPDATE projects SET name=:name, description=:description, members_id=:members_id WHERE id=:id');
 
        $affectedLines = $query->execute(array('name' => $name, 'description' => $description, 'members_id' => $members_id, 'id' => intval($id)));

        $query->closeCursor();

        return $affectedLines;
    }

    function getProjectProgress($id)
    {
        $db = $this->dbConnect();
        $query = $db->prepare('SELECT SUM(estimated_duration * progress / 100) AS time_passed FROM tasks WHERE project_id=:project_id');


        $query->execute(array('project_id'=>$id));

        $result = $query->fetch();

        $time_passed = $result['time_passed'];

        $query->closeCursor();
        
        $query = $db->prepare('SELECT SUM(estimated_duration) AS total_time FROM tasks WHERE project_id=:project_id');
        
        $query->execute(array('project_id'=>$id));    

        $result = $query->fetch();

        $total_time = $result['total_time'];

        $query->closeCursor();
        return round(($time_passed/$total_time)*100, 2);
    }
}
