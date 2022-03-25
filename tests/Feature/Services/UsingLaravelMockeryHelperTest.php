<?php

namespace Tests\Feature\Services;

use App\Services\HelperService;
use Tests\TestCase;

class UsingLaravelMockeryHelperTest extends TestCase
{

    /** @test */
    public function it_will_call_service_with_correct_values()
    {
        $leftNumber = 5;
        $rightNumber = 5;
        $mockedService = $this->mock(HelperService::class);
        $mockedService->shouldReceive("hitsAnApiMethod")
            ->with($leftNumber, $rightNumber)->once();
        $mockedService->shouldReceive("activeBackgroundGnome");

        $this->withoutExceptionHandling();
        $this->postJson(route('world.end'), [
            "leftNumber" => $leftNumber,
            "rightNumber" => $rightNumber
        ])
            ->assertOk();
    }
}
