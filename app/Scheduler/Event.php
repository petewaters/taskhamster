<?php

namespace TaskHamster\Scheduler;

use Cron\CronExpression;

abstract class Event
{
    public $expression = '* * * * *';

    abstract public function handle();

    public function isDueToRun()
    {
        return CronExpression::factory($this->expression)->isDue();
    }
}