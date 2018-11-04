<?php

namespace Tests\Unit;

use App\Models\Reminder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderModelTest extends TestCase
{
    use RefreshDatabase;

    private $reminder;

    public function setUp()
    {
        parent::setUp();

        $this->reminder = factory(Reminder::class)->create([
            'repeat' => 'monthly',
            'reminder_date' => '2018-11-07',
            'type' => 'birthday'
        ]);
    }
    
    /** @test */
    public function repeat_is_upper_case_first()
    {
        $this->assertEquals('Monthly', $this->reminder->repeat);
    }

    /** @test */
    public function type_is_upper_case_first()
    {
        $this->assertEquals('Birthday', $this->reminder->type);
    }
    
    /** @test */
    public function reminder_date_attribute_format_is_correct()
    {
        $this->assertEquals('Nov 7th', $this->reminder->reminder_date);
    }

    /** @test */
    public function yearly_attribute_test()
    {
        $this->reminder = factory(Reminder::class)->create([
            'repeat' => 'yearly',
            'reminder_date' => '2018-11-07',
            'type' => 'birthday'
        ]);

        $this->assertEquals('Nov 7th, 2018', $this->reminder->reminder_date);
    }

    /** @test */
    public function default_attribute_test()
    {
        $this->reminder = factory(Reminder::class)->create([
            'repeat' => 'xcv',
            'reminder_date' => '2018-11-07',
            'type' => 'birthday'
        ]);

        $this->assertEquals('default', $this->reminder->reminder_date);
    }
}
