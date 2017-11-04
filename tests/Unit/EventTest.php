<?php

use PHPUnit\Framework\TestCase;

use TaskHamster\Scheduler\Event;

class EventTest extends TestCase
{
    /** @test */
    public function event_has_default_cron_expression()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertEquals($event->expression, '* * * * *');
    }

    /** @test */
    public function event_should_be_run()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertTrue($event->isDueToRun());
    }
}