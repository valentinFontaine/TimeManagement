<?php


function createMember($first_name, $last_name, $mail, $pass)
{
    require_once('model/MembersManager.php');

    $member = new MembersManager();

    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    $affectedLines = $member->createMember($first_name, $last_name,$mail, $pass_hash);

    if ($affectedLines === false)
    {
        throw new Exception ('Le compte n\'a pas pu être ajouté'); 
    }
    else
    {
        $newMember = $member->getMemberByMail($mail);

        $_SESSION['id'] = $newMember['id'];

        header('Location: index.php');
    }
}

function verifyIdentity($mail, $pass)
{

    require_once('model/MembersManager.php');

    $member = new MembersManager();

    $currentMember = $member->getMemberByMail($mail);

    if (password_verify($pass, $currentMember['pass']))
    {
        $_SESSION['id'] = $currentMember['id'];
        header('Location: index.php?action=welcome');
    }
    else
    {
        header('Location: index.php?action=connection&error=1');
    }
}
function verifySubscription()
{

    require_once('model/MembersManager.php');
    $members = new MembersManager();

    if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['mail']) AND !empty($_POST['password_1']) AND !empty($_POST['password_2']))
    {
        $existingMember = $members->getMemberByMail($_POST['mail']);

        if (!empty($existingMember))
        {
            header('Location: index.php?action=subscription&error=mailAlreadyTaken');
        }
        elseif ($_POST['password_1'] != $_POST['password_2'])
        {
            header('Location: index.php?action=subscription&error=differentPassword');
        }
        else
        {
            createMember($_POST['first_name'], $_POST['last_name'], $_POST['mail'], $_POST['password_1']);
        }
    }
    else
    {
        header('Location: index.php?action=subscription&error=fieldEmpty');
    }
}

function connection()
{

    if (isset($_GET['error']))
    {
        $errorMessage = 'L\'identifiant ou le mot de passe n\'est pas valide';
    }
    else
    {
        $errorMessage = '';
    }
    require('view/connectionView.php');
}

function subscription()
{
    if (isset($_GET['error']))
    {
        if  ($_GET['error'] == 'differentPasswords')
        {
            $errorMessage = 'Les deux mots de passes entrés ne sont pas identiques';
        }
        elseif ($_GET['error'] == 'mailAlreadyTaken')
        {
            $errorMessage = 'L\'adresse mail entrée possède déjà un compte';
        }
        elseif($_GET['error'] == 'fieldEmpty')
        {
            $errorMessage = 'Tous les champs ne sont pas remplis';
        }
        else
        {
            $errorMessage = 'Impossible de créer le compte';
        }
    }
    else
    {
        $errorMessage = '';
    }
    require_once('view/subscriptionView.php');
}

function signOut()
{
    $_SESSION = array();
    $_SESSION['id'] = '';
    
    session_destroy();

    header('Location: view/signOutView.php');

}

