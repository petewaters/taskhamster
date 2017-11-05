<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Carbon\Carbon;

use TaskHamster\Scheduler\Kernel;
use TaskHamster\Events\SomeEvent;

$kernel = new Kernel;
$kernel->setDate(Carbon::now()->tz('Europe/London'));

/**
 * Scheduled tasks
 */
$kernel->add(new SomeEvent)->daily()->at(9, 0);

$kernel->run();