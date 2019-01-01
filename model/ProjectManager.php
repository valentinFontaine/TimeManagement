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

        $query = $db->prepare('SELECT id, members_id, name, description FROM projects WHERE id = :id');

        $project = $query->execute(array('id' => $id));

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


}
