<?php

use Bernard\Message\PlainMessage;
use Bernard\Router\SimpleRouter;
use Bernard\Consumer;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Bernard\Queue\RoundRobinQueue;

require __DIR__ . '/../vendor/autoload.php';

$queueFactory = require __DIR__. '/../app/queueFactory.php';

$queues = [
  'message-queue-1',
  'message-queue-2'
];

$router = new SimpleRouter();
$router->add('SendMessage1', function(PlainMessage $message) {
  print_r(PHP_EOL . 'Q1=> sending message: ' . $message['text']);
});

$router->add('SendMessage2', function(PlainMessage $message) {
  print_r(PHP_EOL . 'Q2=> sending message: ' . $message['text']);
});

$eventDispatcher = new EventDispatcher();
$eventDispatcher->addListener(
    Bernard\BernardEvents::ACKNOWLEDGE,
    function(Bernard\Event\EnvelopeEvent $envelopeEvent) {
        echo PHP_EOL . 'Processed: ' . $envelopeEvent->getEnvelope()->getClass();
    }
);

$queues = array_map(
  function ($queueName) use ($queueFactory) {
    return $queueFactory->create($queueName);
  },
  $queues
);

// Create a Consumer and start the loop.
$consumer = new Consumer($router, $eventDispatcher);
$consumer->consume(new RoundRobinQueue($queues));