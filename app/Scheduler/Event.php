<?php

namespace TaskHamster\Scheduler;

use Cron\CronExpression;
use Carbon\Carbon;

abstract class Event
{
    public $expression = '* * * * *';

    abstract public function handle();

    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)->isDue($date);
    }
}
