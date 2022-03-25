<?php

namespace Tests\Feature\Services;

use App\Services\HelperService;
use Tests\TestCase;

class LaravelAppContainerOverrideTest extends TestCase
{
    /** @test */
    public function it_will_call_helper_service()
    {
        $mockService = new class(false) extends HelperService {
            public function __construct(public $serviceWasCalled) {}

            public function hitsAnApiMethod($leftNumber, $rightNumber)
            {
                $this->serviceWasCalled = true;
            }
        };
        app()->instance(HelperService::class, $mockService);

        $this->postJson(route('world.end'), [
            "leftNumber" => 5,
            "rightNumber" => 15
        ])
            ->assertOk();

        $this->assertTrue($mockService->serviceWasCalled);
    }

    /** @test */
    public function it_will_call_service_with_correct_values()
    {
        $leftNumber = 5;
        $rightNumber = 15;
        $mockService = new class(0,0) extends HelperService {
            public function __construct(public $leftNumber, public $rightNumber) {}

            public function hitsAnApiMethod($leftNumber, $rightNumber)
            {
                $this->leftNumber = $leftNumber;
                $this->rightNumber = $rightNumber;
            }
        };
        app()->instance(HelperService::class, $mockService);

        $this->postJson(route('world.end'), [
            "leftNumber" => $leftNumber,
            "rightNumber" => $rightNumber
        ])
            ->assertOk();

        $this->assertEquals($leftNumber, $mockService->leftNumber);
        $this->assertEquals($rightNumber, $mockService->rightNumber);
    }
}
