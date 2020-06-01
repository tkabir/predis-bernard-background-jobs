<?php

use Bernard\Driver\PredisDriver;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer;
use Predis\Client;

$predis = new Client('tcp://localhost', array(
    'prefix' => 'bernard:',
));
$driver = new PredisDriver($predis);

//.. create $driver
$queueFactory = new PersistentFactory($driver, new Serializer());

return $queueFactory;