<?php $title = 'Planification de la journée'; ?>

<?php ob_start(); ?>

<h2> Planification de la journée </h2>


<table>
    <tr>
        <th>Temps</th>
        <th>Tâche</th>
    </tr>
<?php
    $time_pitch =  30;
    $start_time = 0;
    $end_time = 1440;
    
    $current_slote = $start_time;
    while($current_slote < $end_time)
    {
?>
    <tr>
        <td>  <?= formateTimeSlote($current_slote, $time_pitch)?> </td> 
        <td></td>
    </tr>
<?php
        $current_slote+= $time_pitch;
    }
?>
</table>
<?php $content = ob_get_clean(); ?>

<?php require('controller/templateConnected.php'); ?>

