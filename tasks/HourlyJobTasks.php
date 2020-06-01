<?php

use Crunz\Schedule;

$schedule = new Schedule();
$task = $schedule->run('php bin/HourlyJobHandler.php');       
$task->hourly();

return $schedule;