<?php

require_once('model/Manager.php');

class MembersManager extends Manager
{
    public function createMember($first_name, $last_name, $mail, $pass)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('INSERT INTO members(first_name, last_name, mail, pass, subscription_date) VALUES(:first_name,:last_name, :mail, :pass, CURDATE())');
        $affectedLines = $req->execute(array('first_name' => $first_name, 'last_name' => $last_name, 'mail' => $mail, 'pass' => $pass));

        $req->closeCursor();
        return $affectedLines;
    }

    public function getMemberByMail($mail)
    {
        $db = $this->dbConnect();
        $members = $db->prepare('SELECT id, mail, first_name, last_name, pass, subscription_date FROM members WHERE mail = ?');

        $members->execute(array($mail));

        $member = $members->fetch();

        $members->closeCursor();

        return $member;
    }
    public function getMember($id)
    {
        $db = $this->dbConnect();
        $members = $db->prepare('SELECT id, mail, first_name, last_name, pass, subscription_date FROM members WHERE id = ?');

        $members->execute(array($id));

        $member = $members->fetch();

        $members->closeCursor();

        return $member;
    }

}
        


