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

    /** @test */
    public function can_set_hourly()
    {
        $frequencies = $this->frequencies();
        $frequencies->hourly();

        $this->assertEquals($frequencies->expression, '1 * * * *');
    }

    /** @test */
    public function can_set_hourly_at()
    {
        $frequencies = $this->frequencies();
        $frequencies->hourlyAt(30);

        $this->assertEquals($frequencies->expression, '30 * * * *');
    }

    /** @test */
    public function can_set_daily()
    {
        $frequencies = $this->frequencies();
        $frequencies->daily();

        $this->assertEquals($frequencies->expression, '0 0 * * *');
    }

    /** @test */
    public function can_set_daily_at()
    {
        $frequencies = $this->frequencies();
        $frequencies->dailyAt(9, 0);

        $this->assertEquals($frequencies->expression, '0 9 * * *');
    }

    /** @test */
    public function can_get_correct_expression_when_chaining()
    {
        $frequencies = $this->frequencies();
        $frequencies->daily()->daily();

        $this->assertEquals($frequencies->expression, '0 0 * * *');
    }

    /** @test */
    public function can_set_daily_at_using_defaults()
    {
        $frequencies = $this->frequencies();
        $frequencies->dailyAt();

        $this->assertEquals($frequencies->expression, '0 0 * * *');
    }

    /** @test */
    public function can_set_twice_daily()
    {
        $frequencies = $this->frequencies();
        $frequencies->twiceDaily(1, 12);

        $this->assertEquals($frequencies->expression, '0 1,12 * * *');
    }

    /** @test */
    public function can_set_twice_daily_using_defaults()
    {
        $frequencies = $this->frequencies();
        $frequencies->twiceDaily();

        $this->assertEquals($frequencies->expression, '0 1,12 * * *');
    }

    /** @test */
    public function can_set_days()
    {
        $frequencies = $this->frequencies();
        $frequencies->days(1, 3, 5);

        $this->assertEquals($frequencies->expression, '* * * * 1,3,5');
    }

     /** @test */
     public function can_set_days_using_defaults()
     {
         $frequencies = $this->frequencies();
         $frequencies->days();
 
         $this->assertEquals($frequencies->expression, '* * * * *');
     }

     /** @test */
    public function can_set_mondays()
    {
        $frequencies = $this->frequencies();
        $frequencies->mondays();

        $this->assertEquals($frequencies->expression, '* * * * 1');
    }

     /** @test */
     public function can_set_tuesdays()
     {
         $frequencies = $this->frequencies();
         $frequencies->tuesdays();
 
         $this->assertEquals($frequencies->expression, '* * * * 2');
     }

      /** @test */
    public function can_set_wednesdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->wednesdays();

        $this->assertEquals($frequencies->expression, '* * * * 3');
    }

     /** @test */
     public function can_set_thursdays()
     {
         $frequencies = $this->frequencies();
         $frequencies->thursdays();
 
         $this->assertEquals($frequencies->expression, '* * * * 4');
     }

      /** @test */
    public function can_set_fridays()
    {
        $frequencies = $this->frequencies();
        $frequencies->fridays();

        $this->assertEquals($frequencies->expression, '* * * * 5');
    }

     /** @test */
     public function can_set_saturdays()
     {
         $frequencies = $this->frequencies();
         $frequencies->saturdays();
 
         $this->assertEquals($frequencies->expression, '* * * * 6');
     }

    /** @test */
    public function can_set_sundays()
    {
        $frequencies = $this->frequencies();
        $frequencies->sundays();

        $this->assertEquals($frequencies->expression, '* * * * 7');
    }

    /** @test */
    public function can_set_weekdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->weekdays();

        $this->assertEquals($frequencies->expression, '* * * * 1,2,3,4,5');
    }

    /** @test */
    public function can_set_weekends()
    {
        $frequencies = $this->frequencies();
        $frequencies->weekends();

        $this->assertEquals($frequencies->expression, '* * * * 6,7');
    }

    /** @test */
    public function can_set_at_time()
    {
        $frequencies = $this->frequencies();
        $frequencies->at(9, 0);

        $this->assertEquals($frequencies->expression, '0 9 * * *');
    }

    /** @test */
    public function can_set_day_and_time()
    {
        $frequencies = $this->frequencies();
        $frequencies->at(9, 0)->weekdays();

        $this->assertEquals($frequencies->expression, '0 9 * * 1,2,3,4,5');
    }

    /** @test */
    public function can_set_weekly()
    {
        $frequencies = $this->frequencies();
        $frequencies->weekly();

        $this->assertEquals($frequencies->expression, '* * * * 0');
    }

    /** @test */
    public function can_set_weekly_on_day()
    {
        $frequencies = $this->frequencies();
        $frequencies->weeklyOn(3);

        $this->assertEquals($frequencies->expression, '* * * * 3');
    }


    /** @test */
    public function can_set_monthly()
    {
        $frequencies = $this->frequencies();
        $frequencies->monthly();

        $this->assertEquals($frequencies->expression, '0 0 1 * *');
    }

    /** @test */
    public function can_set_monthly_on_day()
    {
        $frequencies = $this->frequencies();
        $frequencies->monthlyOn(13);

        $this->assertEquals($frequencies->expression, '0 0 13 * *');
    }

    protected function frequencies()
    {
        $frequencies = $this->getMockForTrait(FrequenciesTrait::class);
        $frequencies->expression = '* * * * *';

        return $frequencies;
    }
}
