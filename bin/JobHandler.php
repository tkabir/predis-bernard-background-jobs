<?php

use Bernard\Message\PlainMessage;
use Bernard\Producer;
use Symfony\Component\EventDispatcher\EventDispatcher;

require __DIR__ . '/../vendor/autoload.php';

$queueFactory = require __DIR__. '/../app/queueFactory.php';
$eventDispatcher = new EventDispatcher();
$producer = new Producer($queueFactory, $eventDispatcher);

$message1 = new PlainMessage('SendMessage1', array(
    'text' => 'sample message 1'
));

$message2 = new PlainMessage('SendMessage2', array(
    'text' => 'sample message 2'
));

$producer->produce($message1, 'message-queue-1');
$producer->produce($message2, 'message-queue-2');