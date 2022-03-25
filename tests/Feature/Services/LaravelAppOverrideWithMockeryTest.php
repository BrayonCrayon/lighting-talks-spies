<?php

namespace Tests\Feature\Services;

use App\Services\HelperService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class LaravelAppOverrideWithMockeryTest extends TestCase
{

    /** @test */
    public function it_will_call_service_with_correct_values()
    {
        $leftNumber = 5;
        $rightNumber = 5;
        $this->withoutExceptionHandling();
        $this->instance(HelperService::class, Mockery::mock(HelperService::class, function (MockInterface $mock) use ($leftNumber, $rightNumber) {
            $mock->shouldReceive("hitsAnApiMethod")->with($rightNumber, $leftNumber)->once();
            $mock->shouldReceive('activeBackgroundGnome')->once();
        }));

        $this->postJson(route('world.end'), [
            "leftNumber" => $leftNumber,
            "rightNumber" => $rightNumber
        ])
            ->assertOk();
    }


    /** @test */
    public function it_will_call_service_with_correct_values_revision()
    {
        $leftNumber = 5;
        $rightNumber = 5;
        $this->withoutExceptionHandling();
        $mockedService = $this->instance(HelperService::class, Mockery::mock(HelperService::class));
        $mockedService->shouldReceive("hitsAnApiMethod")->with($rightNumber, $leftNumber)->once();
        $mockedService->shouldReceive('activeBackgroundGnome')->once();

        $this->postJson(route('world.end'), [
            "leftNumber" => $leftNumber,
            "rightNumber" => $rightNumber
        ])
            ->assertOk();
    }
}
