<?php

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;

use TaskHamster\Scheduler\Kernel;
use TaskHamster\Scheduler\Event;

class KernelTest extends TestCase
{
    /** @test */
    public function can_get_kernel_events()
    {
        $kernel = new Kernel;

        $this->assertEquals([], $kernel->getEvents());
    }

    /** @test */
    public function can_add_events_to_kernel()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $kernel = new Kernel;
        $kernel->add($event);

        $this->assertCount(1, $kernel->getEvents());
    }

    /** @test */
    public function cannot_add_non_events_to_kernel()
    {
        $this->expectException(TypeError::class);

        $kernel = new Kernel;
        $kernel->add('blended hamsters');
    }

    /** @test */
    public function can_set_date()
    {
        $kernel = new Kernel;
        $kernel->setDate(Carbon::now());

        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    /** @test */
    public function kernel_has_default_date_if_non_specified()
    {
        $kernel = new Kernel;
        
        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    /** @test */
    public function runs_expected_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);
        $event->expects($this->once())->method('handle');

        $kernel = new Kernel;
        $kernel->add($event);
        
        $kernel->run();
    }

    /** @test */
    public function does_not_runs_unexpected_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);
        $event->monthly();
        $event->expects($this->never())->method('handle');

        $kernel = new Kernel;
        $kernel->setDate(Carbon::create(2017, 11, 5, 0, 0, 0));
        $kernel->add($event);
        
        $kernel->run();
    }

    /** @test */
    public function adding_event_returns_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $kernel = new Kernel;
        $result = $kernel->add($event);
        
        $this->assertInstanceOf(Event::class, $result);
    }
}
