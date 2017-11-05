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
    public function can_insert_cron_expression()
    {
        $frequencies = $this->frequencies();
        $frequencies->insertIntoExpression(1, '*/10');

        $this->assertEquals($frequencies->expression, '*/10 * * * *');
    }

    /** @test */
    public function can_chain_insert_cron_expressions()
    {
        $frequencies = $this->frequencies();
        $frequencies->insertIntoExpression(1, '*/10')->insertIntoExpression(2, '1');

        $this->assertEquals($frequencies->expression, '*/10 1 * * *');
    }

    /** @test */
    public function can_insert_cron_expressions_using_array()
    {
        $frequencies = $this->frequencies();
        $frequencies->insertIntoExpression(1, ['*/10', '1']);

        $this->assertEquals($frequencies->expression, '*/10 1 * * *');
    }

    /** @test */
    public function cannot_replace_past_end_of_expression()
    {
        $frequencies = $this->frequencies();
        $frequencies->insertIntoExpression(5, ['*/10', '1']);

        $this->assertEquals($frequencies->expression, '* * * * */10');
    }


    /** @test */
    public function can_set_every_minute()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyMinute();

        $this->assertEquals($frequencies->expression, '* * * * *');
    }

    /** @test */
    public function can_set_every_ten_minutes()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyTenMinutes();

        $this->assertEquals($frequencies->expression, '*/10 * * * *');
    }

    /** @test */
    public function can_set_every_quarter_hour()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyQuarterHour();

        $this->assertEquals($frequencies->expression, '*/15 * * * *');
    }

    /** @test */
    public function can_set_every_half_hour()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyHalfHour();

        $this->assertEquals($frequencies->expression, '*/30 * * * *');
    }

    protected function frequencies()
    {
        $frequencies = $this->getMockForTrait(FrequenciesTrait::class);
        $frequencies->expression = '* * * * *';

        return $frequencies;
    }
}
