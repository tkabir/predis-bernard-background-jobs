<?php

use Bernard\Message\PlainMessage;
use Bernard\Producer;
use Symfony\Component\EventDispatcher\EventDispatcher;

require __DIR__ . '/../vendor/autoload.php';

$queueFactory = require __DIR__. '/../app/queueFactory.php';
$eventDispatcher = new EventDispatcher();
$producer = new Producer($queueFactory, $eventDispatcher);

$message1 = new PlainMessage('SendMessageHourly', array(
    'text' => 'sample message hourly'
));

$producer->produce($message1, 'hourly-message-queue');