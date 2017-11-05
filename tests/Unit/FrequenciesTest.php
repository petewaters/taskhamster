<?php

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;

use TaskHamster\Traits\FrequenciesTrait;

class FrequenciesTest extends TestCase
{
    /** @test */
    public function can_set_cron_expression()
    {
        $frequencies = $this->frequencies();
        $frequencies->cron('an expression');

        $this->assertEquals($frequencies->expression, 'an expression');
    }

    /** @test */
    public function can_set_every_minute()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyMinute();

        $this->assertEquals($frequencies->expression, '* * * * *');
    }

    protected function frequencies()
    {
        $frequencies = $this->getMockForTrait(FrequenciesTrait::class);
        $frequencies->expression = '* * * * *';

        return $frequencies;
    }
}
