<?php

session_start();

try
{
    require('controller/members.php');
    require('controller/task.php');

    
    if (isset($_SESSION['id'])) 
    {
        if (isset($_GET['action']))
        {
            switch ($_GET['action'])
            {

                case 'signOut':
                    signOut();
                    break;

                 case 'welcome':
                    welcome();
                    break;
                    
                case 'listTask' :
                    listTask();
                    break;

                case 'addTask' :
                    if (isset($_POST['category']) AND isset($_POST['project']) AND isset($_POST['task']) AND isset($_POST['description']) AND isset($_POST['importance']) AND isset($_POST['estimated_duration']) AND isset($_POST['due_date']))
                    {
                        addTask($_POST['category'], $_POST['project'], $_POST['task'], $_POST['description'], $_POST['estimated_duration'], $_POST['importance'], $_POST['due_date']);
                    }
                    else
                    {
                        throw new Exception('Champs manquants');
                    }
                    break;

                case 'endTask' :
                    endTask(getTaskCheckId($_POST));
                    break;

                case 'connection':
                case 'verifyIdentity':
                case 'subscription':
                case 'verifySubscription':
                    welcome();
                    break;

                default:
                    throw new Exception('Action non défini');
                    break;
            }
        }
        else
        {
            welcome();
        }

    }
    else
    {
        if (isset($_GET['action']))
        {
            switch ($_GET['action'])
            {
                case 'connection':
                    connection();
                    break;

                case 'verifyIdentity' : 
                    if (isset($_POST['mail']) and isset($_POST['pass']))
                    {
                        verifyIdentity($_POST['mail'], $_POST['pass']);
                    }
                    else
                    {
                        throw new Exception('Mail ou mot de passe non défini');
                    }
                    break;

                case 'subscription':
                    subscription();
                    break;

                 case 'welcome':
                    welcome();
                    break;
                    
                case 'verifySubscription':
                    if (isset($_POST['first_name']) AND isset($_POST['last_name']) AND isset($_POST['mail']) AND isset($_POST['password_1']) AND isset($_POST['password_2']))
                    {
                        verifySubscription();
                    }
                    else
                    {
                        throw new Exception('Inscription non réussie');
                    }
                    break;

                default:
                    connection();
                    break;
            }
        }
        else
        {
                connection();
        }
    }
}
catch(Exception $e)
{
    echo die($e->getMessage()); 
}
