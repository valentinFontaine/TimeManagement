<?php


function listScheduleDay($day)
{
    require_once('model/ScheduleManager.php');


    require('view/scheduleView.php');
}

function formateTimeSlote($start_time_slote, $pitch)
{
    $hour = floor($start_time_slote / 60);
    $minutes = ceil((($start_time_slote/60) - $hour) * 60);

    $return_string = $hour . 'h' . $minutes;

    $minutes = $minutes + $pitch;

    if ($minutes >=60)
    {
        $hour++;
        $minutes-= 60;
    }

    $return_string = $return_string . '-' . $hour . 'h' . $minutes;

    return $return_string;
}


